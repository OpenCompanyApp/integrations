<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Apps Update App Thumbnail.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/apps/{name}/thumbnail.
 */
class DatabricksAppsUpdateAppThumbnail extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_apps_update_app_thumbnail';
    protected const DESCRIPTION = 'Apps Update App Thumbnail

Official Databricks SDK endpoint: PATCH /api/2.0/apps/{name}/thumbnail

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the Databricks SDK endpoint.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Optional query string parameters matching the Databricks REST API request fields.',
  ),
  'headers' =>
  array (
    'type' => 'object',
    'description' => 'Optional additional request headers for advanced Databricks endpoints.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Optional JSON request body matching the Databricks REST API request fields.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.0/apps/{name}/thumbnail';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
