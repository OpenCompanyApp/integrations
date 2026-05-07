<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Serving Update Provisioned Throughput Endpoint Config.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/serving-endpoints/pt/{name}/config.
 */
class DatabricksServingUpdateProvisionedThroughputEndpointConfig extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_serving_update_provisioned_throughput_endpoint_config';
    protected const DESCRIPTION = 'Serving Update Provisioned Throughput Endpoint Config

Official Databricks SDK endpoint: PUT /api/2.0/serving-endpoints/pt/{name}/config

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/serving-endpoints/pt/{name}/config';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
