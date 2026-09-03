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
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_dmds_data;");

        // ── 2. Créer la procédure ──────────────────────────────────────────────
        DB::unprepared("
            CREATE PROCEDURE sp_get_dmds_data(
                IN p_user_id BIGINT
            )
            BEGIN
                DECLARE v_role_id TINYINT;
                DECLARE v_consulat_id INT;

                
                SELECT
                    p.role_id,
                    u.consulat_id
                INTO
                    v_role_id,
                    v_consulat_id
                FROM users u
                INNER JOIN profiles p ON p.id = u.profile_id
                WHERE u.id = p_user_id
                  AND u.deleted_at IS NULL
                LIMIT 1;

                
                IF v_role_id = 1 THEN
                    SELECT
                        doc.id,
                        dmd.uuid,
                        dmd.number,
                        dmd.price,
                        dmd.copy,
                        dmd.status,
                        dmd.delivered_at,
                        dmd.recovered_at,
                        dmd.path,
                        CONCAT_WS(' ', usr.civility, usr.firstname, usr.lastname) AS username,
                        doc.label AS label
                    FROM demands dmd
                    INNER JOIN users usr ON usr.id = dmd.user_id
                    INNER JOIN documents doc ON doc.id = dmd.document_id
                    WHERE dmd.consulat_id = v_consulat_id
                    AND dmd.deleted_at IS NULL
                    ORDER BY dmd.created_at DESC;

                
                ELSEIF v_role_id = 2 THEN
                    SELECT
                        doc.id,
                        dmd.uuid,
                        dmd.number,
                        dmd.price,
                        dmd.copy,
                        dmd.status,
                        dmd.delivered_at,
                        dmd.recovered_at,
                        dmd.path,
                        CONCAT_WS(' ', usr.civility, usr.firstname, usr.lastname) AS username,
                        doc.label AS label
                    FROM demands dmd
                    INNER JOIN users usr ON usr.id = dmd.user_id
                    INNER JOIN documents doc ON doc.id = dmd.document_id
                    WHERE dmd.deleted_at IS NULL
                      AND dmd.consulat_id = v_consulat_id
                      AND dmd.status != 0
                    ORDER BY dmd.created_at DESC;

                
                ELSEIF v_role_id = 3 THEN
                    SELECT
                        doc.id,
                        dmd.uuid,
                        dmd.number,
                        dmd.price,
                        dmd.copy,
                        dmd.status,
                        dmd.delivered_at,
                        dmd.recovered_at,
                        dmd.path,
                        CONCAT_WS(' ', usr.civility, usr.firstname, usr.lastname) AS username,
                        doc.label AS label
                    FROM demands dmd
                    INNER JOIN users usr ON usr.id = dmd.user_id
                    INNER JOIN documents doc ON doc.id = dmd.document_id
                    WHERE dmd.deleted_at IS NULL
                      AND dmd.consulat_id = v_consulat_id
                    ORDER BY dmd.created_at DESC;

                END IF;

            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_list_demands');
    }
};