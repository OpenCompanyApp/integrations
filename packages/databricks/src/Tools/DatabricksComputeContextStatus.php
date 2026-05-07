<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute Context Status.
 *
 * Maps to the official Databricks SDK endpoint get /api/1.2/contexts/status.
 */
class DatabricksComputeContextStatus extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_context_status';
    protected const DESCRIPTION = 'Compute Context Status

Official Databricks SDK endpoint: GET /api/1.2/contexts/status

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/1.2/contexts/status';
    protected const PATH_PARAMS = array (
);
}
