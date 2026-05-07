<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Theme With Id.
 *
 * Maps to POST /api/theme/{themeId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateThemeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_theme_with_id',
  'class' => 'FusionAuthCreateThemeWithId',
  'method' => 'POST',
  'path' => '/api/theme/{themeId}',
  'operation_id' => 'createThemeWithId',
  'summary' => 'create Theme With Id',
  'description' => 'Creates a Theme. You can optionally specify an Id for the theme, if not provided one will be generated.',
  'parameters' =>
  array (
    'theme_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the theme. If not provided a secure random UUID will be generated.',
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
