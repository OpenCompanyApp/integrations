<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Workspace Set Permissions.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/permissions/{workspace_object_type}/{workspace_object_id}.
 */
class DatabricksWorkspaceSetPermissions2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_workspace_set_permissions_2';
    protected const DESCRIPTION = 'Workspace Set Permissions

Official Databricks SDK endpoint: PUT /api/2.0/permissions/{workspace_object_type}/{workspace_object_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'workspace_object_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `workspace_object_type` from the Databricks SDK endpoint.',
  ),
  'workspace_object_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `workspace_object_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/permissions/{workspace_object_type}/{workspace_object_id}';
    protected const PATH_PARAMS = array (
  'workspace_object_type' => 'workspace_object_type',
  'workspace_object_id' => 'workspace_object_id',
);
}
