<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create connector.
 *
 * Maps to POST /api/connectors in the official Logto OpenAPI source.
 */
class LogtoCreateConnector extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_connector',
  'class' => 'LogtoCreateConnector',
  'method' => 'POST',
  'path' => '/api/connectors',
  'operation_id' => 'CreateConnector',
  'summary' => 'Create connector',
  'description' => 'Create a connector with the given data.',
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
