<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Apps Update Custom Template.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/apps-settings/templates/{name}.
 */
class DatabricksAppsUpdateCustomTemplate extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_apps_update_custom_template';
    protected const DESCRIPTION = 'Apps Update Custom Template

Official Databricks SDK endpoint: PUT /api/2.0/apps-settings/templates/{name}

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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.0/apps-settings/templates/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
