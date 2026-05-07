<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get connector's authorization URI.
 *
 * Maps to POST /api/connectors/{connectorId}/authorization-uri in the official Logto OpenAPI source.
 */
class LogtoCreateConnectorAuthorizationUri extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_connector_authorization_uri',
  'class' => 'LogtoCreateConnectorAuthorizationUri',
  'method' => 'POST',
  'path' => '/api/connectors/{connectorId}/authorization-uri',
  'operation_id' => 'CreateConnectorAuthorizationUri',
  'summary' => 'Get connector\'s authorization URI',
  'description' => 'Get authorization URI for specified connector by providing redirect URI and randomly generated state.',
  'parameters' =>
  array (
    'connector_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the connector.',
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
    'connectorId' => 'connector_id',
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
