<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update SSO connector.
 *
 * Maps to PATCH /api/sso-connectors/{id} in the official Logto OpenAPI source.
 */
class LogtoUpdateSsoConnector extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_sso_connector',
  'class' => 'LogtoUpdateSsoConnector',
  'method' => 'PATCH',
  'path' => '/api/sso-connectors/{id}',
  'operation_id' => 'UpdateSsoConnector',
  'summary' => 'Update SSO connector',
  'description' => 'Update an SSO connector by ID. This method performs a partial update.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the sso connector.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
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
