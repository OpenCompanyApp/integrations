<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Generate backup codes.
 *
 * Maps to POST /api/my-account/mfa-verifications/backup-codes/generate in the official Logto OpenAPI source.
 */
class LogtoGenerateMyAccountBackupCodes extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_generate_my_account_backup_codes',
  'class' => 'LogtoGenerateMyAccountBackupCodes',
  'method' => 'POST',
  'path' => '/api/my-account/mfa-verifications/backup-codes/generate',
  'operation_id' => 'GenerateMyAccountBackupCodes',
  'summary' => 'Generate backup codes',
  'description' => 'Generate backup codes for the user.',
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
