<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Theme With Id.
 *
 * Maps to PATCH /api/theme/{themeId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchThemeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_theme_with_id',
  'class' => 'FusionAuthPatchThemeWithId',
  'method' => 'PATCH',
  'path' => '/api/theme/{themeId}',
  'operation_id' => 'patchThemeWithId',
  'summary' => 'patch Theme With Id',
  'description' => 'Updates, via PATCH, the theme with the given Id.',
  'parameters' =>
  array (
    'theme_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the theme to update.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
