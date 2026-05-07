<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute All Cluster Statuses.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/libraries/all-cluster-statuses.
 */
class DatabricksComputeAllClusterStatuses extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_all_cluster_statuses';
    protected const DESCRIPTION = 'Compute All Cluster Statuses

Official Databricks SDK endpoint: GET /api/2.0/libraries/all-cluster-statuses

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
    protected const PATH = '/api/2.0/libraries/all-cluster-statuses';
    protected const PATH_PARAMS = array (
);
}
