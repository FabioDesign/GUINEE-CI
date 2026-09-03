<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ── 1. Supprimer la procédure s'il existe ──────────────────────────────
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_chart_docs_data;");

        // ── 2. Créer la procédure ──────────────────────────────────────────────
        DB::unprepared("
            CREATE PROCEDURE sp_chart_docs_data(
                IN p_consulat_id BIGINT,
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
			    | Statistiques des documents
			    |--------------------------------------------------------------------------
			    */
                SELECT
                    doc.id,
                    doc.label,
                    COALESCE(SUM(dmd.copy), 0) AS total
                FROM documents doc
                LEFT JOIN demands AS dmd
			        ON dmd.document_id = doc.id
			        AND dmd.consulat_id = p_consulat_id
			        AND dmd.status = 2
			        AND dmd.validated_at >= p_start_date
			        AND dmd.validated_at < DATE_ADD(p_end_date, INTERVAL 1 DAY)
                WHERE doc.status = 1
                GROUP BY doc.id, doc.label
                ORDER BY doc.label ASC;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_chart_documents');
    }
};