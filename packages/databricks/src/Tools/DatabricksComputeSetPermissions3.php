<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute Set Permissions.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/permissions/instance-pools/{instance_pool_id}.
 */
class DatabricksComputeSetPermissions3 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_set_permissions_3';
    protected const DESCRIPTION = 'Compute Set Permissions

Official Databricks SDK endpoint: PUT /api/2.0/permissions/instance-pools/{instance_pool_id}

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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.0/permissions/instance-pools/{instance_pool_id}';
    protected const PATH_PARAMS = array (
  'instance_pool_id' => 'instance_pool_id',
);
}
