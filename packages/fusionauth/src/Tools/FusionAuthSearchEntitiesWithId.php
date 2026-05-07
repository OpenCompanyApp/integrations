<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Entities With Id.
 *
 * Maps to POST /api/entity/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchEntitiesWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_entities_with_id',
  'class' => 'FusionAuthSearchEntitiesWithId',
  'method' => 'POST',
  'path' => '/api/entity/search',
  'operation_id' => 'searchEntitiesWithId',
  'summary' => 'search Entities With Id',
  'description' => 'Searches entities with the specified criteria and pagination.',
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
