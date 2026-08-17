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

                DECLARE v_year INT;
                DECLARE v_month INT;
                DECLARE v_paid INT DEFAULT 0;
                DECLARE v_free INT DEFAULT 0;

                /* ================================
                1. VALIDATION (status = 2)
                ================================ */
                IF NEW.status = 2 AND OLD.status <> 2 THEN

                    SET v_year  = YEAR(NEW.validated_at);
                    SET v_month = MONTH(NEW.validated_at);

                    -- Répartition paid / free
                    IF NEW.price = 0 THEN
                        SET v_free = NEW.copy;
                        SET v_paid = 0;
                    ELSE
                        SET v_paid = NEW.copy;
                        SET v_free = 0;
                    END IF;

                    -- MONTHLY STATS
                    INSERT INTO monthly_stats 
                        (years, months, amount, paid, free, recover, consulat_id, document_id, created_at)
                    VALUES 
                        (v_year, v_month, NEW.price, v_paid, v_free, 0, NEW.consulat_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        amount = amount + NEW.price,
                        paid   = paid   + v_paid,
                        free   = free   + v_free;

                    -- ANNUAL STATS
                    INSERT INTO annual_stats 
                        (years, amount, paid, free, recover, consulat_id, document_id, created_at)
                    VALUES 
                        (v_year, NEW.price, v_paid, v_free, 0, NEW.consulat_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        amount = amount + NEW.price,
                        paid   = paid   + v_paid,
                        free   = free   + v_free;

                END IF;

                /* ================================
                2. CREATION
                ================================ */
                IF NEW.created_at IS NOT NULL AND OLD.created_at IS NULL THEN

                    SET v_year  = YEAR(NEW.created_at);
                    SET v_month = MONTH(NEW.created_at);

                    -- MONTHLY STATS
                    INSERT INTO monthly_stats 
                        (years, months, created, consulat_id, document_id, created_at)
                    VALUES 
                        (v_year, v_month, 1, NEW.consulat_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        created = created + 1;

                    -- ANNUAL STATS
                    INSERT INTO annual_stats 
                        (years, created, consulat_id, document_id, created_at)
                    VALUES 
                        (v_year, 1, NEW.consulat_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        created = created + 1;

                END IF;

                /* ================================
                3. TRANSMITION
                ================================ */
                IF NEW.transmitted_at IS NOT NULL AND OLD.transmitted_at IS NULL THEN

                    SET v_year  = YEAR(NEW.transmitted_at);
                    SET v_month = MONTH(NEW.transmitted_at);

                    -- MONTHLY STATS
                    INSERT INTO monthly_stats 
                        (years, months, transmitted, consulat_id, document_id, created_at)
                    VALUES 
                        (v_year, v_month, 1, NEW.consulat_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        transmitted = transmitted + 1;

                    -- ANNUAL STATS
                    INSERT INTO annual_stats 
                        (years, transmitted, consulat_id, document_id, created_at)
                    VALUES 
                        (v_year, 1, NEW.consulat_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        transmitted = transmitted + 1;

                END IF;

                /* ================================
                4. VALIDATION
                ================================ */
                IF NEW.validated_at IS NOT NULL AND OLD.validated_at IS NULL THEN

                    SET v_year  = YEAR(NEW.validated_at);
                    SET v_month = MONTH(NEW.validated_at);

                    -- MONTHLY STATS
                    INSERT INTO monthly_stats 
                        (years, months, validated, consulat_id, document_id, created_at)
                    VALUES 
                        (v_year, v_month, 1, NEW.consulat_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        validated = validated + 1;

                    -- ANNUAL STATS
                    INSERT INTO annual_stats 
                        (years, validated, consulat_id, document_id, created_at)
                    VALUES 
                        (v_year, 1, NEW.consulat_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        validated = validated + 1;

                END IF;

                /* ================================
                5. REJECTION
                ================================ */
                IF NEW.rejected_at IS NOT NULL AND OLD.rejected_at IS NULL THEN

                    SET v_year  = YEAR(NEW.rejected_at);
                    SET v_month = MONTH(NEW.rejected_at);

                    -- MONTHLY STATS
                    INSERT INTO monthly_stats 
                        (years, months, rejected, consulat_id, document_id, created_at)
                    VALUES 
                        (v_year, v_month, 1, NEW.consulat_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        rejected = rejected + 1;

                    -- ANNUAL STATS
                    INSERT INTO annual_stats 
                        (years, rejected, consulat_id, document_id, created_at)
                    VALUES 
                        (v_year, 1, NEW.consulat_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        rejected = rejected + 1;

                END IF;

                /* ================================
                6. RECUPERATION
                ================================ */
                IF NEW.recovered_at IS NOT NULL AND OLD.recovered_at IS NULL THEN

                    SET v_year  = YEAR(NEW.recovered_at);
                    SET v_month = MONTH(NEW.recovered_at);

                    -- MONTHLY STATS
                    INSERT INTO monthly_stats 
                        (years, months, recovered, consulat_id, document_id, created_at)
                    VALUES 
                        (v_year, v_month, 1, NEW.consulat_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        recovered = recovered + 1;

                    -- ANNUAL STATS
                    INSERT INTO annual_stats 
                        (years, recovered, consulat_id, document_id, created_at)
                    VALUES 
                        (v_year, 1, NEW.consulat_id, NEW.document_id, NOW())
                    ON DUPLICATE KEY UPDATE
                        recovered = recovered + 1;

                END IF;

            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS valid_demands");
    }
};