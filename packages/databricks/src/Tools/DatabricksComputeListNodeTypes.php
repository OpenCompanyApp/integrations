<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute List Node Types.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/clusters/list-node-types.
 */
class DatabricksComputeListNodeTypes extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_list_node_types';
    protected const DESCRIPTION = 'Compute List Node Types

Official Databricks SDK endpoint: GET /api/2.1/clusters/list-node-types

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
    protected const PATH = '/api/2.1/clusters/list-node-types';
    protected const PATH_PARAMS = array (
);
}
