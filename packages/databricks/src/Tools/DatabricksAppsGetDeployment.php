<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Apps Get Deployment.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/apps/{app_name}/deployments/{deployment_id}.
 */
class DatabricksAppsGetDeployment extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_apps_get_deployment';
    protected const DESCRIPTION = 'Apps Get Deployment

Official Databricks SDK endpoint: GET /api/2.0/apps/{app_name}/deployments/{deployment_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'app_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `app_name` from the Databricks SDK endpoint.',
  ),
  'deployment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `deployment_id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/apps/{app_name}/deployments/{deployment_id}';
    protected const PATH_PARAMS = array (
  'app_name' => 'app_name',
  'deployment_id' => 'deployment_id',
);
}
