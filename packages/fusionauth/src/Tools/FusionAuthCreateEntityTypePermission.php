<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Entity Type Permission.
 *
 * Maps to POST /api/entity/type/{entityTypeId}/permission in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateEntityTypePermission extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_entity_type_permission',
  'class' => 'FusionAuthCreateEntityTypePermission',
  'method' => 'POST',
  'path' => '/api/entity/type/{entityTypeId}/permission',
  'operation_id' => 'createEntityTypePermission',
  'summary' => 'create Entity Type Permission',
  'description' => 'Creates a new permission for an entity type. You must specify the Id of the entity type you are creating the permission for. You can optionally specify an Id for the permission inside the EntityTypePermission object itself, if not provided one will be generated.',
  'parameters' =>
  array (
    'entity_type_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the entity type to create the permission on.',
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
