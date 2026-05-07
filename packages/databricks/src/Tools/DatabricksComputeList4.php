<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute List.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/instance-pools/list.
 */
class DatabricksComputeList4 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_list_4';
    protected const DESCRIPTION = 'Compute List

Official Databricks SDK endpoint: GET /api/2.0/instance-pools/list

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
    protected const PATH = '/api/2.0/instance-pools/list';
    protected const PATH_PARAMS = array (
);
}
