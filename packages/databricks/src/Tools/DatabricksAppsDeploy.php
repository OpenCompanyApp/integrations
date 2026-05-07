<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Apps Deploy.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/apps/{app_name}/deployments.
 */
class DatabricksAppsDeploy extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_apps_deploy';
    protected const DESCRIPTION = 'Apps Deploy

Official Databricks SDK endpoint: POST /api/2.0/apps/{app_name}/deployments

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
    protected const PATH = '/api/2.0/apps/{app_name}/deployments';
    protected const PATH_PARAMS = array (
  'app_name' => 'app_name',
);
}
