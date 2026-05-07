<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Networking Get Endpoint.
 *
 * Maps to the official Databricks SDK endpoint get /api/networking/v1/{name}.
 */
class DatabricksNetworkingGetEndpoint extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_networking_get_endpoint';
    protected const DESCRIPTION = 'Networking Get Endpoint

Official Databricks SDK endpoint: GET /api/networking/v1/{name}

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
    protected const METHOD = 'get';
    protected const PATH = '/api/networking/v1/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
