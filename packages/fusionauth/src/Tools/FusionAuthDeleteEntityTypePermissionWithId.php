<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Entity Type Permission With Id.
 *
 * Maps to DELETE /api/entity/type/{entityTypeId}/permission/{permissionId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteEntityTypePermissionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_entity_type_permission_with_id',
  'class' => 'FusionAuthDeleteEntityTypePermissionWithId',
  'method' => 'DELETE',
  'path' => '/api/entity/type/{entityTypeId}/permission/{permissionId}',
  'operation_id' => 'deleteEntityTypePermissionWithId',
  'summary' => 'delete Entity Type Permission With Id',
  'description' => 'Hard deletes a permission. This is a dangerous operation and should not be used in most circumstances. This permanently removes the given permission from all grants that had it.',
  'parameters' =>
  array (
    'entity_type_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the entityType the the permission belongs to.',
    ),
    'permission_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the permission to delete.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
