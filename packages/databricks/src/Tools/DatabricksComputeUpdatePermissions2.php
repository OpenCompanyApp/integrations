<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute Update Permissions.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/permissions/clusters/{cluster_id}.
 */
class DatabricksComputeUpdatePermissions2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_update_permissions_2';
    protected const DESCRIPTION = 'Compute Update Permissions

Official Databricks SDK endpoint: PATCH /api/2.0/permissions/clusters/{cluster_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'cluster_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `cluster_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/permissions/clusters/{cluster_id}';
    protected const PATH_PARAMS = array (
  'cluster_id' => 'cluster_id',
);
}
