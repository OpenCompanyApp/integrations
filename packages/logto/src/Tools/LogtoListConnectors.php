<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get connectors.
 *
 * Maps to GET /api/connectors in the official Logto OpenAPI source.
 */
class LogtoListConnectors extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_connectors',
  'class' => 'LogtoListConnectors',
  'method' => 'GET',
  'path' => '/api/connectors',
  'operation_id' => 'ListConnectors',
  'summary' => 'Get connectors',
  'description' => 'Get all connectors in the current tenant.',
  'parameters' =>
  array (
    'target' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Filter connectors by target.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'target' => 'target',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
