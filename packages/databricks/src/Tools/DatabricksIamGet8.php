<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iam Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/accounts/{account_id}/workspaces/{workspace_id}/permissionassignments/permissions.
 */
class DatabricksIamGet8 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iam_get_8';
    protected const DESCRIPTION = 'Iam Get

Official Databricks SDK endpoint: GET /api/2.0/accounts/{account_id}/workspaces/{workspace_id}/permissionassignments/permissions

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/accounts/{account_id}/workspaces/{workspace_id}/permissionassignments/permissions';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'workspace_id' => 'workspace_id',
);
}
