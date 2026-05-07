<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Users By Ids With Id.
 *
 * Maps to GET /api/user/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchUsersByIdsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_users_by_ids_with_id',
  'class' => 'FusionAuthSearchUsersByIdsWithId',
  'method' => 'GET',
  'path' => '/api/user/search',
  'operation_id' => 'searchUsersByIdsWithId',
  'summary' => 'search Users By Ids With Id',
  'description' => 'Retrieves the users for the given Ids. If any Id is invalid, it is ignored.',
  'parameters' =>
  array (
    'ids' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The user Ids to search for.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'ids' => 'ids',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
