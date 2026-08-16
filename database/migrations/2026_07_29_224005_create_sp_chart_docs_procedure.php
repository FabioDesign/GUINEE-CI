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
                IN p_years YEAR
            )
            BEGIN
                SELECT
                    d.id,
                    d.label,
                    COALESCE(SUM(a.paid), 0) + COALESCE(SUM(a.free), 0) AS total
                FROM documents d
                LEFT JOIN annual_stats a
                    ON a.document_id = d.id
                    AND a.consulat_id = p_consulat_id
                    AND a.years = p_years
                WHERE d.status = 1
                GROUP BY d.id, d.label
                ORDER BY d.label ASC;
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