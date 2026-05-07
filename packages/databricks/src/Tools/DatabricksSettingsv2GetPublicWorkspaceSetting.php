<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settingsv2 Get Public Workspace Setting.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/settings/{name}.
 */
class DatabricksSettingsv2GetPublicWorkspaceSetting extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settingsv2_get_public_workspace_setting';
    protected const DESCRIPTION = 'Settingsv2 Get Public Workspace Setting

Official Databricks SDK endpoint: GET /api/2.1/settings/{name}

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.1/settings/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
