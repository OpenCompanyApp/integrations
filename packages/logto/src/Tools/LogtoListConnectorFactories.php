<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get connector factories.
 *
 * Maps to GET /api/connector-factories in the official Logto OpenAPI source.
 */
class LogtoListConnectorFactories extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_connector_factories',
  'class' => 'LogtoListConnectorFactories',
  'method' => 'GET',
  'path' => '/api/connector-factories',
  'operation_id' => 'ListConnectorFactories',
  'summary' => 'Get connector factories',
  'description' => 'Get all connector factories data available in Logto.',
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
