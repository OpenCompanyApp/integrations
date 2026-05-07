<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get the application constants.
 *
 * Maps to GET /api/systems/application in the official Logto OpenAPI source.
 */
class LogtoGetSystemApplicationConfig extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_system_application_config',
  'class' => 'LogtoGetSystemApplicationConfig',
  'method' => 'GET',
  'path' => '/api/systems/application',
  'operation_id' => 'GetSystemApplicationConfig',
  'summary' => 'Get the application constants',
  'description' => 'Get the application constants.',
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
