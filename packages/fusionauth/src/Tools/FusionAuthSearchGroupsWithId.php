<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Groups With Id.
 *
 * Maps to POST /api/group/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchGroupsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_groups_with_id',
  'class' => 'FusionAuthSearchGroupsWithId',
  'method' => 'POST',
  'path' => '/api/group/search',
  'operation_id' => 'searchGroupsWithId',
  'summary' => 'search Groups With Id',
  'description' => 'Searches groups with the specified criteria and pagination.',
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
