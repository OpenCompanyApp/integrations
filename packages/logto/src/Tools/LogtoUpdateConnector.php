<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update connector.
 *
 * Maps to PATCH /api/connectors/{id} in the official Logto OpenAPI source.
 */
class LogtoUpdateConnector extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_connector',
  'class' => 'LogtoUpdateConnector',
  'method' => 'PATCH',
  'path' => '/api/connectors/{id}',
  'operation_id' => 'UpdateConnector',
  'summary' => 'Update connector',
  'description' => 'Update connector by ID with the given data. This methods performs a partial update.',
  'parameters' =>
  array (
    'id' =>
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
