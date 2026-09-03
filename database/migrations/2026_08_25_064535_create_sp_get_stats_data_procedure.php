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
			    IN p_start_date DATE,
			    IN p_end_date DATE
			)
			BEGIN
			
			    /*
			    |--------------------------------------------------------------------------
			    | Validation des dates
			    |--------------------------------------------------------------------------
			    */
			    IF p_start_date IS NULL OR p_end_date IS NULL THEN
			        SIGNAL SQLSTATE '45000'
			        SET MESSAGE_TEXT = 'La date de début et la date de fin sont obligatoires.';
			    END IF;
			
			    IF p_start_date > p_end_date THEN
			        SIGNAL SQLSTATE '45000'
			        SET MESSAGE_TEXT = 'La date de début ne peut pas être supérieure à la date de fin.';
			    END IF;
			
			
			    /*
			    |--------------------------------------------------------------------------
			    | Statistiques
			    |--------------------------------------------------------------------------
			    */
			    SELECT
			        COALESCE(SUM(d.price), 0) AS amount,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.price <> 0 THEN d.copy
			                ELSE 0
			            END
			        ), 0) AS paid,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.price = 0 THEN d.copy
			                ELSE 0
			            END
			        ), 0) AS free,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.created_at IS NOT NULL THEN 1
			                ELSE 0
			            END
			        ), 0) AS created,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.transmitted_at IS NOT NULL THEN 1
			                ELSE 0
			            END
			        ), 0) AS transmitted,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.validated_at IS NOT NULL THEN 1
			                ELSE 0
			            END
			        ), 0) AS validated,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.rejected_at IS NOT NULL THEN 1
			                ELSE 0
			            END
			        ), 0) AS rejected,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.recovered_at IS NOT NULL THEN 1
			                ELSE 0
			            END
			        ), 0) AS recovered			
			    FROM demands AS d
			    WHERE d.consulat_id = p_consulat_id			
		      	AND (
		            p_document_id IS NULL
		            OR d.document_id = p_document_id
		          )			
		      	AND d.validated_at >= p_start_date			
		      	AND d.validated_at < DATE_ADD(p_end_date, INTERVAL 1 DAY)			
		      	AND d.status = 2;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_stats_data");
    }
};