<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Serving Create Provisioned Throughput Endpoint.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/serving-endpoints/pt.
 */
class DatabricksServingCreateProvisionedThroughputEndpoint extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_serving_create_provisioned_throughput_endpoint';
    protected const DESCRIPTION = 'Serving Create Provisioned Throughput Endpoint

Official Databricks SDK endpoint: POST /api/2.0/serving-endpoints/pt

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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.0/serving-endpoints/pt';
    protected const PATH_PARAMS = array (
);
}
