<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ── 1. Supprimer le trigger s'il existe ──────────────────────────────
        DB::unprepared("DROP TRIGGER IF EXISTS valid_demands");

        // ── 2. Créer le trigger ───────────────────────────────────────────────
        DB::unprepared("
            CREATE TRIGGER valid_demands
            AFTER UPDATE ON demands
            FOR EACH ROW
            BEGIN

                DECLARE v_year  INT;
                DECLARE v_month INT;
                DECLARE v_paids INT DEFAULT 0;
                DECLARE v_frees INT DEFAULT 0;

                IF NEW.status = 2 THEN

                    SET v_year  = YEAR(NEW.validated_at);
                    SET v_month = MONTH(NEW.validated_at);
                    SET v_paids = 0;
                    SET v_frees = 0;

                    IF NEW.price = 0 THEN
                        SET v_frees = NEW.copy;
                    ELSE
                        SET v_paids = NEW.copy;
                    END IF;

                    -- UPDATE STATS MENSUELLES
                    INSERT INTO monthly_stats (years, months, amount, number, paid, free, agency_id, document_id, created_at)
                    VALUES (v_year, v_month, NEW.price, NEW.copy, v_paids, v_frees, NEW.agency_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        amount = amount + NEW.price,
                        number = number + NEW.copy,
                        paid   = paid   + v_paids,
                        free   = free   + v_frees;

                    -- UPDATE STATS ANNUELLES
                    INSERT INTO annual_stats (years, amount, number, paid, free, agency_id, document_id, created_at)
                    VALUES (v_year, NEW.price, NEW.copy, v_paids, v_frees, NEW.agency_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        amount = amount + NEW.price,
                        number = number + NEW.copy,
                        paid   = paid   + v_paids,
                        free   = free   + v_frees;

                END IF;

            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS valid_demands");
    }
};