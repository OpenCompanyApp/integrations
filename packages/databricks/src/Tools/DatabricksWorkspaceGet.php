<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Workspace Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/git-credentials/{credential_id}.
 */
class DatabricksWorkspaceGet extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_workspace_get';
    protected const DESCRIPTION = 'Workspace Get

Official Databricks SDK endpoint: GET /api/2.0/git-credentials/{credential_id}

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/git-credentials/{credential_id}';
    protected const PATH_PARAMS = array (
  'credential_id' => 'credential_id',
);
}
