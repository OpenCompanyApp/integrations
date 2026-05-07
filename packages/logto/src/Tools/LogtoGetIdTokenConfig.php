<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get ID token claims configuration.
 *
 * Maps to GET /api/configs/id-token in the official Logto OpenAPI source.
 */
class LogtoGetIdTokenConfig extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_id_token_config',
  'class' => 'LogtoGetIdTokenConfig',
  'method' => 'GET',
  'path' => '/api/configs/id-token',
  'operation_id' => 'GetIdTokenConfig',
  'summary' => 'Get ID token claims configuration',
  'description' => 'Get the ID token extended claims configuration for the tenant. This configuration controls which extended claims (e.g., `custom_data`, `identities`, `roles`, `organizations`, `organization_roles`) are included in ID tokens.',
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
