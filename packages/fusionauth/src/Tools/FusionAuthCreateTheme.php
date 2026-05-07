<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Theme.
 *
 * Maps to POST /api/theme in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateTheme extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_theme',
  'class' => 'FusionAuthCreateTheme',
  'method' => 'POST',
  'path' => '/api/theme',
  'operation_id' => 'createTheme',
  'summary' => 'create Theme',
  'description' => 'Creates a Theme. You can optionally specify an Id for the theme, if not provided one will be generated.',
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
