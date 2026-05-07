<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Connector With Id.
 *
 * Maps to DELETE /api/connector/{connectorId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteConnectorWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_connector_with_id',
  'class' => 'FusionAuthDeleteConnectorWithId',
  'method' => 'DELETE',
  'path' => '/api/connector/{connectorId}',
  'operation_id' => 'deleteConnectorWithId',
  'summary' => 'delete Connector With Id',
  'description' => 'Deletes the connector for the given Id.',
  'parameters' =>
  array (
    'connector_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the connector to delete.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
