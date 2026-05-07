<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Apps Set Permissions.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/permissions/apps/{app_name}.
 */
class DatabricksAppsSetPermissions extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_apps_set_permissions';
    protected const DESCRIPTION = 'Apps Set Permissions

Official Databricks SDK endpoint: PUT /api/2.0/permissions/apps/{app_name}

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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.0/permissions/apps/{app_name}';
    protected const PATH_PARAMS = array (
  'app_name' => 'app_name',
);
}
