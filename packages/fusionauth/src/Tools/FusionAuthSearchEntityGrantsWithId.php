<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Entity Grants With Id.
 *
 * Maps to POST /api/entity/grant/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchEntityGrantsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_entity_grants_with_id',
  'class' => 'FusionAuthSearchEntityGrantsWithId',
  'method' => 'POST',
  'path' => '/api/entity/grant/search',
  'operation_id' => 'searchEntityGrantsWithId',
  'summary' => 'search Entity Grants With Id',
  'description' => 'Searches Entity Grants with the specified criteria and pagination.',
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
