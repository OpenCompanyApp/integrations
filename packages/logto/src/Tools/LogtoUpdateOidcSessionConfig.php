<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update OIDC session config.
 *
 * Maps to PATCH /api/configs/oidc/session in the official Logto OpenAPI source.
 */
class LogtoUpdateOidcSessionConfig extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_oidc_session_config',
  'class' => 'LogtoUpdateOidcSessionConfig',
  'method' => 'PATCH',
  'path' => '/api/configs/oidc/session',
  'operation_id' => 'UpdateOidcSessionConfig',
  'summary' => 'Update OIDC session config',
  'description' => 'Update the OIDC session configuration for the tenant. This method performs a partial update. If the configuration does not exist, it will be created.',
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
