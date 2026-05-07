<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Environments Update Default Workspace Base Environment.
 *
 * Maps to the official Databricks SDK endpoint patch /api/environments/v1/{name}.
 */
class DatabricksEnvironmentsUpdateDefaultWorkspaceBaseEnvironment extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_environments_update_default_workspace_base_environment';
    protected const DESCRIPTION = 'Environments Update Default Workspace Base Environment

Official Databricks SDK endpoint: PATCH /api/environments/v1/{name}

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
    protected const PATH = '/api/environments/v1/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
