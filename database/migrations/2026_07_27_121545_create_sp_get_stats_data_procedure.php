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
                IN p_consulat_id INT,
                IN p_document_id INT,
                IN p_years INT,
                IN p_months INT,
                IN p_days INT
            )
            BEGIN
                DECLARE v_amount DECIMAL(15, 0) DEFAULT 0;
                DECLARE v_paid DECIMAL(10, 0) DEFAULT 0;
                DECLARE v_free DECIMAL(10, 0) DEFAULT 0;
                DECLARE v_create DECIMAL(10, 0) DEFAULT 0;
                DECLARE v_transmit DECIMAL(10, 0) DEFAULT 0;
                DECLARE v_validat DECIMAL(10, 0) DEFAULT 0;
                DECLARE v_reject DECIMAL(10, 0) DEFAULT 0;
                DECLARE v_recover DECIMAL(10, 0) DEFAULT 0;

                
                IF p_days IS NOT NULL THEN

                    SELECT 
                        COALESCE(SUM(price), 0),
                        COALESCE(SUM(CASE WHEN price <> 0 THEN copy ELSE 0 END), 0),
                        COALESCE(SUM(CASE WHEN price = 0 THEN copy ELSE 0 END), 0),
                        COALESCE(SUM(CASE WHEN created_at IS NOT NULL THEN 1 ELSE 0 END), 0),
                        COALESCE(SUM(CASE WHEN transmitted_at IS NOT NULL THEN 1 ELSE 0 END), 0),
                        COALESCE(SUM(CASE WHEN validated_at IS NOT NULL THEN 1 ELSE 0 END), 0),
                        COALESCE(SUM(CASE WHEN rejected_at IS NOT NULL THEN 1 ELSE 0 END), 0),
                        COALESCE(SUM(CASE WHEN recovered_at IS NOT NULL THEN 1 ELSE 0 END), 0)
                    INTO
                        v_amount,
                        v_paid,
                        v_free,
                        v_create,
                        v_transmit,
                        v_validat,
                        v_reject,
                        v_recover
                    FROM demands
                    WHERE consulat_id = p_consulat_id
                    AND (p_document_id IS NULL OR document_id = p_document_id)
                    AND validated_at >= STR_TO_DATE(
                        CONCAT(p_years, '-', LPAD(p_months, 2, '0'), '-', LPAD(p_days, 2, '0')),
                        '%Y-%m-%d'
                    )
                    AND validated_at < DATE_ADD(
                        STR_TO_DATE(
                            CONCAT(p_years, '-', LPAD(p_months, 2, '0'), '-', LPAD(p_days, 2, '0')),
                            '%Y-%m-%d'
                        ),
                        INTERVAL 1 DAY
                    )
                    AND status = 2;

                
                ELSEIF p_months IS NOT NULL THEN

                    SELECT 
                        COALESCE(SUM(amount), 0),
                        COALESCE(SUM(paid), 0),
                        COALESCE(SUM(free), 0),
                        COALESCE(SUM(created), 0),
                        COALESCE(SUM(transmitted), 0),
                        COALESCE(SUM(validated), 0),
                        COALESCE(SUM(rejected), 0),
                        COALESCE(SUM(recovered), 0)
                    INTO
                        v_amount,
                        v_paid,
                        v_free,
                        v_create,
                        v_transmit,
                        v_validat,
                        v_reject,
                        v_recover
                    FROM monthly_stats
                    WHERE consulat_id = p_consulat_id
                    AND (p_document_id IS NULL OR document_id = p_document_id)
                    AND years = p_years
                    AND months = p_months;

                
                ELSEIF p_years IS NOT NULL THEN

                    SELECT 
                        COALESCE(SUM(amount), 0),
                        COALESCE(SUM(paid), 0),
                        COALESCE(SUM(free), 0),
                        COALESCE(SUM(created), 0),
                        COALESCE(SUM(transmitted), 0),
                        COALESCE(SUM(validated), 0),
                        COALESCE(SUM(rejected), 0),
                        COALESCE(SUM(recovered), 0)
                    INTO
                        v_amount,
                        v_paid,
                        v_free,
                        v_create,
                        v_transmit,
                        v_validat,
                        v_reject,
                        v_recover
                    FROM annual_stats
                    WHERE consulat_id = p_consulat_id
                    AND (p_document_id IS NULL OR document_id = p_document_id)
                    AND years = p_years;

                
                ELSE

                    SELECT 
                        COALESCE(SUM(amount), 0),
                        COALESCE(SUM(paid), 0),
                        COALESCE(SUM(free), 0),
                        COALESCE(SUM(created), 0),
                        COALESCE(SUM(transmitted), 0),
                        COALESCE(SUM(validated), 0),
                        COALESCE(SUM(rejected), 0),
                        COALESCE(SUM(recovered), 0)
                    INTO
                        v_amount,
                        v_paid,
                        v_free,
                        v_create,
                        v_transmit,
                        v_validat,
                        v_reject,
                        v_recover
                    FROM annual_stats
                    WHERE consulat_id = p_consulat_id
                    AND (p_document_id IS NULL OR document_id = p_document_id);

                END IF;

                
                SELECT 
                    v_amount 	AS amount,
                    v_paid   	AS paid,
                    v_free   	AS free,
                    v_create   	AS created,
                    v_transmit  AS transmitted,
                    v_validat   AS validated,
                    v_reject   	AS rejected,
                    v_recover   AS recovered;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_stats_data");
    }
};