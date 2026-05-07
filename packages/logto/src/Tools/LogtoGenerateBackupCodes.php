<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Generate backup codes.
 *
 * Maps to POST /api/experience/verification/backup-code/generate in the official Logto OpenAPI source.
 */
class LogtoGenerateBackupCodes extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_generate_backup_codes',
  'class' => 'LogtoGenerateBackupCodes',
  'method' => 'POST',
  'path' => '/api/experience/verification/backup-code/generate',
  'operation_id' => 'GenerateBackupCodes',
  'summary' => 'Generate backup codes',
  'description' => 'Create a new BackupCode verification record with new backup codes generated. This verification record will be used to bind the backup codes to the user\'s profile.',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
