<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Entities By Ids With Id.
 *
 * Maps to GET /api/entity/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchEntitiesByIdsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_entities_by_ids_with_id',
  'class' => 'FusionAuthSearchEntitiesByIdsWithId',
  'method' => 'GET',
  'path' => '/api/entity/search',
  'operation_id' => 'searchEntitiesByIdsWithId',
  'summary' => 'search Entities By Ids With Id',
  'description' => 'Retrieves the entities for the given Ids. If any Id is invalid, it is ignored.',
  'parameters' =>
  array (
    'ids' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The entity ids to search for.',
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
