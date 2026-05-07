<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Entity Type Permission With Id.
 *
 * Maps to PATCH /api/entity/type/{entityTypeId}/permission/{permissionId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchEntityTypePermissionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_entity_type_permission_with_id',
  'class' => 'FusionAuthPatchEntityTypePermissionWithId',
  'method' => 'PATCH',
  'path' => '/api/entity/type/{entityTypeId}/permission/{permissionId}',
  'operation_id' => 'patchEntityTypePermissionWithId',
  'summary' => 'patch Entity Type Permission With Id',
  'description' => 'Patches the permission with the given Id for the entity type.',
  'parameters' =>
  array (
    'entity_type_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the entityType that the permission belongs to.',
    ),
    'permission_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the permission to patch.',
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
    'permissionId' => 'permission_id',
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
