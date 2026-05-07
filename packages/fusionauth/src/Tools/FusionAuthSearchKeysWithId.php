<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Keys With Id.
 *
 * Maps to POST /api/key/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchKeysWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_keys_with_id',
  'class' => 'FusionAuthSearchKeysWithId',
  'method' => 'POST',
  'path' => '/api/key/search',
  'operation_id' => 'searchKeysWithId',
  'summary' => 'search Keys With Id',
  'description' => 'Searches keys with the specified criteria and pagination.',
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
