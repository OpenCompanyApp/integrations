<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create SSO connector.
 *
 * Maps to POST /api/sso-connectors in the official Logto OpenAPI source.
 */
class LogtoCreateSsoConnector extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_sso_connector',
  'class' => 'LogtoCreateSsoConnector',
  'method' => 'POST',
  'path' => '/api/sso-connectors',
  'operation_id' => 'CreateSsoConnector',
  'summary' => 'Create SSO connector',
  'description' => 'Create an new SSO connector instance for a given provider.',
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
