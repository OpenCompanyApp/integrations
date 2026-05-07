<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Entity Type With Id.
 *
 * Maps to DELETE /api/entity/type/{entityTypeId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteEntityTypeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_entity_type_with_id',
  'class' => 'FusionAuthDeleteEntityTypeWithId',
  'method' => 'DELETE',
  'path' => '/api/entity/type/{entityTypeId}',
  'operation_id' => 'deleteEntityTypeWithId',
  'summary' => 'delete Entity Type With Id',
  'description' => 'Deletes the Entity Type for the given Id.',
  'parameters' =>
  array (
    'entity_type_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the Entity Type to delete.',
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
  'type' => 'write',
);
}
