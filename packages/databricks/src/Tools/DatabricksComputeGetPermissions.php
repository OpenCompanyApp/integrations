<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute Get Permissions.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/permissions/cluster-policies/{cluster_policy_id}.
 */
class DatabricksComputeGetPermissions extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_get_permissions';
    protected const DESCRIPTION = 'Compute Get Permissions

Official Databricks SDK endpoint: GET /api/2.0/permissions/cluster-policies/{cluster_policy_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'cluster_policy_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `cluster_policy_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/permissions/cluster-policies/{cluster_policy_id}';
    protected const PATH_PARAMS = array (
  'cluster_policy_id' => 'cluster_policy_id',
);
}
