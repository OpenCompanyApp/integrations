<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Apps List Custom Templates.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/apps-settings/templates.
 */
class DatabricksAppsListCustomTemplates extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_apps_list_custom_templates';
    protected const DESCRIPTION = 'Apps List Custom Templates

Official Databricks SDK endpoint: GET /api/2.0/apps-settings/templates

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
    protected const PATH = '/api/2.0/apps-settings/templates';
    protected const PATH_PARAMS = array (
);
}
