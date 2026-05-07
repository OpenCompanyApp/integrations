<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get admin console config.
 *
 * Maps to GET /api/configs/admin-console in the official Logto OpenAPI source.
 */
class LogtoGetAdminConsoleConfig extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_admin_console_config',
  'class' => 'LogtoGetAdminConsoleConfig',
  'method' => 'GET',
  'path' => '/api/configs/admin-console',
  'operation_id' => 'GetAdminConsoleConfig',
  'summary' => 'Get admin console config',
  'description' => 'Get the global configuration object for Logto Console.',
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
