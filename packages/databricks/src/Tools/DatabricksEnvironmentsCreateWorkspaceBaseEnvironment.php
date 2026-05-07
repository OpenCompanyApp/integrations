<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Environments Create Workspace Base Environment.
 *
 * Maps to the official Databricks SDK endpoint post /api/environments/v1/workspace-base-environments.
 */
class DatabricksEnvironmentsCreateWorkspaceBaseEnvironment extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_environments_create_workspace_base_environment';
    protected const DESCRIPTION = 'Environments Create Workspace Base Environment

Official Databricks SDK endpoint: POST /api/environments/v1/workspace-base-environments

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
    protected const METHOD = 'post';
    protected const PATH = '/api/environments/v1/workspace-base-environments';
    protected const PATH_PARAMS = array (
);
}
