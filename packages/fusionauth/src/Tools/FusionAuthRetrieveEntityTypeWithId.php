<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Entity Type With Id.
 *
 * Maps to GET /api/entity/type/{entityTypeId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveEntityTypeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_entity_type_with_id',
  'class' => 'FusionAuthRetrieveEntityTypeWithId',
  'method' => 'GET',
  'path' => '/api/entity/type/{entityTypeId}',
  'operation_id' => 'retrieveEntityTypeWithId',
  'summary' => 'retrieve Entity Type With Id',
  'description' => 'Retrieves the Entity Type for the given Id.',
  'parameters' =>
  array (
    'entity_type_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the Entity Type.',
    ),
  ),
  'path_params' =>
  array (
    'entityTypeId' => 'entity_type_id',
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
