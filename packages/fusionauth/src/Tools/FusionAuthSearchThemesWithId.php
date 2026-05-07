<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Themes With Id.
 *
 * Maps to POST /api/theme/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchThemesWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_themes_with_id',
  'class' => 'FusionAuthSearchThemesWithId',
  'method' => 'POST',
  'path' => '/api/theme/search',
  'operation_id' => 'searchThemesWithId',
  'summary' => 'search Themes With Id',
  'description' => 'Searches themes with the specified criteria and pagination.',
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
