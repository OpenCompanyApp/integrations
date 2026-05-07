<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Entity Types With Id.
 *
 * Maps to POST /api/entity/type/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchEntityTypesWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_entity_types_with_id',
  'class' => 'FusionAuthSearchEntityTypesWithId',
  'method' => 'POST',
  'path' => '/api/entity/type/search',
  'operation_id' => 'searchEntityTypesWithId',
  'summary' => 'search Entity Types With Id',
  'description' => 'Searches the entity types with the specified criteria and pagination.',
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
