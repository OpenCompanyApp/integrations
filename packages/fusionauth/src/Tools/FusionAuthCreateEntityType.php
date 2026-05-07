<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Entity Type.
 *
 * Maps to POST /api/entity/type in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateEntityType extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_entity_type',
  'class' => 'FusionAuthCreateEntityType',
  'method' => 'POST',
  'path' => '/api/entity/type',
  'operation_id' => 'createEntityType',
  'summary' => 'create Entity Type',
  'description' => 'Creates a Entity Type. You can optionally specify an Id for the Entity Type, if not provided one will be generated.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
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
