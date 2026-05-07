<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get connector.
 *
 * Maps to GET /api/connectors/{id} in the official Logto OpenAPI source.
 */
class LogtoGetConnector extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_connector',
  'class' => 'LogtoGetConnector',
  'method' => 'GET',
  'path' => '/api/connectors/{id}',
  'operation_id' => 'GetConnector',
  'summary' => 'Get connector',
  'description' => 'Get connector data by ID',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the connector.',
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
  'type' => 'read',
);
}
