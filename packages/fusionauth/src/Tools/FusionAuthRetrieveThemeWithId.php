<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Theme With Id.
 *
 * Maps to GET /api/theme/{themeId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveThemeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_theme_with_id',
  'class' => 'FusionAuthRetrieveThemeWithId',
  'method' => 'GET',
  'path' => '/api/theme/{themeId}',
  'operation_id' => 'retrieveThemeWithId',
  'summary' => 'retrieve Theme With Id',
  'description' => 'Retrieves the theme for the given Id.',
  'parameters' =>
  array (
    'theme_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the theme.',
    ),
  ),
  'path_params' =>
  array (
    'themeId' => 'theme_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
