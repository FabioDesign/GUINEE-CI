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

                -- Récupérer le role_id et consulat_id de l'utilisateur connecté
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

                -- role_id = 1 : Administrateur → toutes les demandes
                IF v_role_id = 1 THEN
                    SELECT
                        dmd.uuid,
                        dmd.reference,
                        dmd.number,
                        dmd.price,
                        dmd.copy,
                        dmd.status,
                        dmd.path,
                        usr.firstname,
                        usr.lastname,
                        usr.civility,
                        doc.label AS label
                    FROM demands dmd
                    INNER JOIN users usr ON usr.id = dmd.user_id
                    INNER JOIN documents doc ON doc.id = dmd.document_id
                    WHERE dmd.deleted_at IS NULL
                    ORDER BY dmd.created_at DESC;

                -- role_id = 2 : Coordonnateur → même consulat sauf status = 0
                ELSEIF v_role_id = 2 THEN
                    SELECT
                        dmd.uuid,
                        dmd.reference,
                        dmd.number,
                        dmd.price,
                        dmd.copy,
                        dmd.status,
                        dmd.path,
                        usr.firstname,
                        usr.lastname,
                        usr.civility,
                        doc.label AS label
                    FROM demands dmd
                    INNER JOIN users usr ON usr.id = dmd.user_id
                    INNER JOIN documents doc ON doc.id = dmd.document_id
                    WHERE dmd.deleted_at IS NULL
                      AND dmd.consulat_id = v_consulat_id
                      AND dmd.status != 0
                    ORDER BY dmd.created_at DESC;

                -- role_id = 3 : Opérateur → même consulat + ses propres brouillons
                ELSEIF v_role_id = 3 THEN
                    SELECT
                        dmd.uuid,
                        dmd.reference,
                        dmd.number,
                        dmd.price,
                        dmd.copy,
                        dmd.status,
                        dmd.path,
                        usr.firstname,
                        usr.lastname,
                        usr.civility,
                        doc.label AS label
                    FROM demands dmd
                    INNER JOIN users usr ON usr.id = dmd.user_id
                    INNER JOIN documents doc ON doc.id = dmd.document_id
                    WHERE dmd.deleted_at IS NULL
                      AND dmd.consulat_id = v_consulat_id
                      AND (
                          dmd.status != 0
                          OR (dmd.status = 0 AND dmd.created_by = p_user_id)
                      )
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