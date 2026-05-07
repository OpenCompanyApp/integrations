<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Workspace Get Permission Levels.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/permissions/{workspace_object_type}/{workspace_object_id}/permissionLevels.
 */
class DatabricksWorkspaceGetPermissionLevels2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_workspace_get_permission_levels_2';
    protected const DESCRIPTION = 'Workspace Get Permission Levels

Official Databricks SDK endpoint: GET /api/2.0/permissions/{workspace_object_type}/{workspace_object_id}/permissionLevels

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/permissions/{workspace_object_type}/{workspace_object_id}/permissionLevels';
    protected const PATH_PARAMS = array (
  'workspace_object_type' => 'workspace_object_type',
  'workspace_object_id' => 'workspace_object_id',
);
}
