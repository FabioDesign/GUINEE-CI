<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ── 1. Supprimer la procédure s'il existe ──────────────────────────────
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_stats_data;");

        // ── 2. Créer la procédure ──────────────────────────────────────────────
        DB::unprepared("
            CREATE PROCEDURE sp_get_stats_data(
                IN p_agency_id INT,
                IN p_document_id INT,
                IN p_years INT,
                IN p_months INT,
                IN p_days INT
            )
            BEGIN
                DECLARE v_amount DECIMAL(15, 0) DEFAULT 0;
                DECLARE v_number DECIMAL(10, 0) DEFAULT 0;
                DECLARE v_paid   DECIMAL(10, 0) DEFAULT 0;
                DECLARE v_free   DECIMAL(10, 0) DEFAULT 0;

                /* =========================
                CAS JOURNALIER
                ========================== */
                IF p_days IS NOT NULL THEN

                    SELECT 
                        COALESCE(SUM(price), 0),
                        COALESCE(SUM(copy), 0),
                        COALESCE(SUM(CASE WHEN price <> 0 THEN copy ELSE 0 END), 0),
                        COALESCE(SUM(CASE WHEN price = 0 THEN copy ELSE 0 END), 0)
                    INTO
                        v_amount,
                        v_number,
                        v_paid,
                        v_free
                    FROM demands
                    WHERE agency_id = p_agency_id
                    AND (p_document_id IS NULL OR document_id = p_document_id)
                    AND validated_at LIKE CONCAT(p_years, '-', p_months, '-', p_days, '%')
                    AND status = 2;

                /* =========================
                CAS MENSUEL
                ========================== */
                ELSEIF p_months IS NOT NULL THEN

                    SELECT 
                        COALESCE(SUM(amount), 0),
                        COALESCE(SUM(number), 0),
                        COALESCE(SUM(paid), 0),
                        COALESCE(SUM(free), 0)
                    INTO
                        v_amount,
                        v_number,
                        v_paid,
                        v_free
                    FROM monthly_stats
                    WHERE agency_id = p_agency_id
                    AND (p_document_id IS NULL OR document_id = p_document_id)
                    AND years = p_years
                    AND months = p_months;

                /* =========================
                CAS ANNUEL
                ========================== */
                ELSE

                    SELECT 
                        COALESCE(SUM(amount), 0),
                        COALESCE(SUM(number), 0),
                        COALESCE(SUM(paid), 0),
                        COALESCE(SUM(free), 0)
                    INTO
                        v_amount,
                        v_number,
                        v_paid,
                        v_free
                    FROM annual_stats
                    WHERE agency_id = p_agency_id
                    AND (p_document_id IS NULL OR document_id = p_document_id)
                    AND years = p_years;

                END IF;

                /* =========================
                RESULTAT FINAL
                ========================== */
                SELECT 
                    v_amount AS amount,
                    v_number AS number,
                    v_paid   AS paid,
                    v_free   AS free;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_stats_data");
    }
};