<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete SSO connector.
 *
 * Maps to DELETE /api/sso-connectors/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteSsoConnector extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_sso_connector',
  'class' => 'LogtoDeleteSsoConnector',
  'method' => 'DELETE',
  'path' => '/api/sso-connectors/{id}',
  'operation_id' => 'DeleteSsoConnector',
  'summary' => 'Delete SSO connector',
  'description' => 'Delete an SSO connector by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the sso connector.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
