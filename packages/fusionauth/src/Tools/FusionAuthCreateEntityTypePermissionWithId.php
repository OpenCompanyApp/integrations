<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Entity Type Permission With Id.
 *
 * Maps to POST /api/entity/type/{entityTypeId}/permission/{permissionId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateEntityTypePermissionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_entity_type_permission_with_id',
  'class' => 'FusionAuthCreateEntityTypePermissionWithId',
  'method' => 'POST',
  'path' => '/api/entity/type/{entityTypeId}/permission/{permissionId}',
  'operation_id' => 'createEntityTypePermissionWithId',
  'summary' => 'create Entity Type Permission With Id',
  'description' => 'Creates a new permission for an entity type. You must specify the Id of the entity type you are creating the permission for. You can optionally specify an Id for the permission inside the EntityTypePermission object itself, if not provided one will be generated.',
  'parameters' =>
  array (
    'entity_type_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the entity type to create the permission on.',
    ),
    'permission_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the permission. If not provided a secure random UUID will be generated.',
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
