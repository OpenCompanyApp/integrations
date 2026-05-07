<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Apps List Spaces.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/app-spaces.
 */
class DatabricksAppsListSpaces extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_apps_list_spaces';
    protected const DESCRIPTION = 'Apps List Spaces

Official Databricks SDK endpoint: GET /api/2.0/app-spaces

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/app-spaces';
    protected const PATH_PARAMS = array (
);
}
