<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Apps Stop.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/apps/{name}/stop.
 */
class DatabricksAppsStop extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_apps_stop';
    protected const DESCRIPTION = 'Apps Stop

Official Databricks SDK endpoint: POST /api/2.0/apps/{name}/stop

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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.0/apps/{name}/stop';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
