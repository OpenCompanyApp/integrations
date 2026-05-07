<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Connector With Id.
 *
 * Maps to GET /api/connector/{connectorId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveConnectorWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_connector_with_id',
  'class' => 'FusionAuthRetrieveConnectorWithId',
  'method' => 'GET',
  'path' => '/api/connector/{connectorId}',
  'operation_id' => 'retrieveConnectorWithId',
  'summary' => 'retrieve Connector With Id',
  'description' => 'Retrieves the connector with the given Id.',
  'parameters' =>
  array (
    'connector_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the connector.',
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
  'type' => 'read',
);
}
