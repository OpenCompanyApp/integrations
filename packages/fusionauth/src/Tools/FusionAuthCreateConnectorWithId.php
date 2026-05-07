<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Connector With Id.
 *
 * Maps to POST /api/connector/{connectorId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateConnectorWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_connector_with_id',
  'class' => 'FusionAuthCreateConnectorWithId',
  'method' => 'POST',
  'path' => '/api/connector/{connectorId}',
  'operation_id' => 'createConnectorWithId',
  'summary' => 'create Connector With Id',
  'description' => 'Creates a connector. You can optionally specify an Id for the connector, if not provided one will be generated.',
  'parameters' =>
  array (
    'connector_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the connector. If not provided a secure random UUID will be generated.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
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
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
