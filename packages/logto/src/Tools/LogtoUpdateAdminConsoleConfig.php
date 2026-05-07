<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update admin console config.
 *
 * Maps to PATCH /api/configs/admin-console in the official Logto OpenAPI source.
 */
class LogtoUpdateAdminConsoleConfig extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_admin_console_config',
  'class' => 'LogtoUpdateAdminConsoleConfig',
  'method' => 'PATCH',
  'path' => '/api/configs/admin-console',
  'operation_id' => 'UpdateAdminConsoleConfig',
  'summary' => 'Update admin console config',
  'description' => 'Update the global configuration object for Logto Console. This method performs a partial update.',
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
