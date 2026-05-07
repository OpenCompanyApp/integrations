<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Connector With Id.
 *
 * Maps to PATCH /api/connector/{connectorId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchConnectorWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_connector_with_id',
  'class' => 'FusionAuthPatchConnectorWithId',
  'method' => 'PATCH',
  'path' => '/api/connector/{connectorId}',
  'operation_id' => 'patchConnectorWithId',
  'summary' => 'patch Connector With Id',
  'description' => 'Updates, via PATCH, the connector with the given Id.',
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
