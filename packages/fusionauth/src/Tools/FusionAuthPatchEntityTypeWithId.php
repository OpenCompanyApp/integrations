<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Entity Type With Id.
 *
 * Maps to PATCH /api/entity/type/{entityTypeId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchEntityTypeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_entity_type_with_id',
  'class' => 'FusionAuthPatchEntityTypeWithId',
  'method' => 'PATCH',
  'path' => '/api/entity/type/{entityTypeId}',
  'operation_id' => 'patchEntityTypeWithId',
  'summary' => 'patch Entity Type With Id',
  'description' => 'Updates, via PATCH, the Entity Type with the given Id.',
  'parameters' =>
  array (
    'entity_type_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the Entity Type to update.',
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
    'entityTypeId' => 'entity_type_id',
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
