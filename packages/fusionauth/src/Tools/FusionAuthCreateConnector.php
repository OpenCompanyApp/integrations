<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Connector.
 *
 * Maps to POST /api/connector in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateConnector extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_connector',
  'class' => 'FusionAuthCreateConnector',
  'method' => 'POST',
  'path' => '/api/connector',
  'operation_id' => 'createConnector',
  'summary' => 'create Connector',
  'description' => 'Creates a connector. You can optionally specify an Id for the connector, if not provided one will be generated.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
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
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
