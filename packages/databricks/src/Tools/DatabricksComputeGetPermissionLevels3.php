<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute Get Permission Levels.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/permissions/instance-pools/{instance_pool_id}/permissionLevels.
 */
class DatabricksComputeGetPermissionLevels3 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_get_permission_levels_3';
    protected const DESCRIPTION = 'Compute Get Permission Levels

Official Databricks SDK endpoint: GET /api/2.0/permissions/instance-pools/{instance_pool_id}/permissionLevels

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'instance_pool_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `instance_pool_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/permissions/instance-pools/{instance_pool_id}/permissionLevels';
    protected const PATH_PARAMS = array (
  'instance_pool_id' => 'instance_pool_id',
);
}
