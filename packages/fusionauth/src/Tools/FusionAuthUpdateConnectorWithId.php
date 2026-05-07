<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Connector With Id.
 *
 * Maps to PUT /api/connector/{connectorId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateConnectorWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_connector_with_id',
  'class' => 'FusionAuthUpdateConnectorWithId',
  'method' => 'PUT',
  'path' => '/api/connector/{connectorId}',
  'operation_id' => 'updateConnectorWithId',
  'summary' => 'update Connector With Id',
  'description' => 'Updates the connector with the given Id.',
  'parameters' =>
  array (
    'connector_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the connector to update.',
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
