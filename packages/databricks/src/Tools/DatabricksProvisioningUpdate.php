<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Provisioning Update.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/accounts/{account_id}/workspaces/{workspace_id}.
 */
class DatabricksProvisioningUpdate extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_provisioning_update';
    protected const DESCRIPTION = 'Provisioning Update

Official Databricks SDK endpoint: PATCH /api/2.0/accounts/{account_id}/workspaces/{workspace_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'workspace_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `workspace_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/accounts/{account_id}/workspaces/{workspace_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'workspace_id' => 'workspace_id',
);
}
