<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get backup codes.
 *
 * Maps to GET /api/my-account/mfa-verifications/backup-codes in the official Logto OpenAPI source.
 */
class LogtoGetBackupCodes extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_backup_codes',
  'class' => 'LogtoGetBackupCodes',
  'method' => 'GET',
  'path' => '/api/my-account/mfa-verifications/backup-codes',
  'operation_id' => 'GetBackupCodes',
  'summary' => 'Get backup codes',
  'description' => 'Get all backup codes for the user with their usage status. Requires identity verification.',
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
  'type' => 'read',
);
}
