<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get OIDC session config.
 *
 * Maps to GET /api/configs/oidc/session in the official Logto OpenAPI source.
 */
class LogtoGetOidcSessionConfig extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_oidc_session_config',
  'class' => 'LogtoGetOidcSessionConfig',
  'method' => 'GET',
  'path' => '/api/configs/oidc/session',
  'operation_id' => 'GetOidcSessionConfig',
  'summary' => 'Get OIDC session config',
  'description' => 'Get the OIDC session configuration for the tenant.',
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
