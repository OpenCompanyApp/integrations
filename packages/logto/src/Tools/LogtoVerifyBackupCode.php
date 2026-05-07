<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify backup code.
 *
 * Maps to POST /api/experience/verification/backup-code/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyBackupCode extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_backup_code',
  'class' => 'LogtoVerifyBackupCode',
  'method' => 'POST',
  'path' => '/api/experience/verification/backup-code/verify',
  'operation_id' => 'VerifyBackupCode',
  'summary' => 'Verify backup code',
  'description' => 'Create a new BackupCode verification record and verify the provided backup code against the user\'s backup codes. The verification record will be marked as verified if the code is correct.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
