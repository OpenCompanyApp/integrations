<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Entity Type With Id.
 *
 * Maps to POST /api/entity/type/{entityTypeId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateEntityTypeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_entity_type_with_id',
  'class' => 'FusionAuthCreateEntityTypeWithId',
  'method' => 'POST',
  'path' => '/api/entity/type/{entityTypeId}',
  'operation_id' => 'createEntityTypeWithId',
  'summary' => 'create Entity Type With Id',
  'description' => 'Creates a Entity Type. You can optionally specify an Id for the Entity Type, if not provided one will be generated.',
  'parameters' =>
  array (
    'entity_type_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the Entity Type. If not provided a secure random UUID will be generated.',
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
