<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute Update.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/global-init-scripts/{script_id}.
 */
class DatabricksComputeUpdate2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_update_2';
    protected const DESCRIPTION = 'Compute Update

Official Databricks SDK endpoint: PATCH /api/2.0/global-init-scripts/{script_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'script_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `script_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/global-init-scripts/{script_id}';
    protected const PATH_PARAMS = array (
  'script_id' => 'script_id',
);
}
