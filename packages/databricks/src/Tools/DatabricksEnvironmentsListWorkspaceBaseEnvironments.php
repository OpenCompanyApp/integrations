<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Environments List Workspace Base Environments.
 *
 * Maps to the official Databricks SDK endpoint get /api/environments/v1/workspace-base-environments.
 */
class DatabricksEnvironmentsListWorkspaceBaseEnvironments extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_environments_list_workspace_base_environments';
    protected const DESCRIPTION = 'Environments List Workspace Base Environments

Official Databricks SDK endpoint: GET /api/environments/v1/workspace-base-environments

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
    protected const PATH = '/api/environments/v1/workspace-base-environments';
    protected const PATH_PARAMS = array (
);
}
