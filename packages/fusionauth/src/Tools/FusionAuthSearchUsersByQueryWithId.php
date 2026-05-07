<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Users By Query With Id.
 *
 * Maps to POST /api/user/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchUsersByQueryWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_users_by_query_with_id',
  'class' => 'FusionAuthSearchUsersByQueryWithId',
  'method' => 'POST',
  'path' => '/api/user/search',
  'operation_id' => 'searchUsersByQueryWithId',
  'summary' => 'search Users By Query With Id',
  'description' => 'Retrieves the users for the given search criteria and pagination.',
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
