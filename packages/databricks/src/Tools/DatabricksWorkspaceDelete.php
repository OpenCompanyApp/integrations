<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Workspace Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/git-credentials/{credential_id}.
 */
class DatabricksWorkspaceDelete extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_workspace_delete';
    protected const DESCRIPTION = 'Workspace Delete

Official Databricks SDK endpoint: DELETE /api/2.0/git-credentials/{credential_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'credential_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `credential_id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.0/git-credentials/{credential_id}';
    protected const PATH_PARAMS = array (
  'credential_id' => 'credential_id',
);
}
