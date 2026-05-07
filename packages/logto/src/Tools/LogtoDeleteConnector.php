<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete connector.
 *
 * Maps to DELETE /api/connectors/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteConnector extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_connector',
  'class' => 'LogtoDeleteConnector',
  'method' => 'DELETE',
  'path' => '/api/connectors/{id}',
  'operation_id' => 'DeleteConnector',
  'summary' => 'Delete connector',
  'description' => 'Delete connector by ID.',
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
  'type' => 'write',
);
}
