<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Apps Create Update.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/apps/{app_name}/update.
 */
class DatabricksAppsCreateUpdate extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_apps_create_update';
    protected const DESCRIPTION = 'Apps Create Update

Official Databricks SDK endpoint: POST /api/2.0/apps/{app_name}/update

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'app_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `app_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/apps/{app_name}/update';
    protected const PATH_PARAMS = array (
  'app_name' => 'app_name',
);
}
