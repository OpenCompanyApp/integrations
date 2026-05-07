<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Theme With Id.
 *
 * Maps to DELETE /api/theme/{themeId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteThemeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_theme_with_id',
  'class' => 'FusionAuthDeleteThemeWithId',
  'method' => 'DELETE',
  'path' => '/api/theme/{themeId}',
  'operation_id' => 'deleteThemeWithId',
  'summary' => 'delete Theme With Id',
  'description' => 'Deletes the theme for the given Id.',
  'parameters' =>
  array (
    'theme_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the theme to delete.',
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
  'type' => 'write',
);
}
