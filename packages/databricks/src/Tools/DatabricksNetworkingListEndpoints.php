<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Networking List Endpoints.
 *
 * Maps to the official Databricks SDK endpoint get /api/networking/v1/{parent}/endpoints.
 */
class DatabricksNetworkingListEndpoints extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_networking_list_endpoints';
    protected const DESCRIPTION = 'Networking List Endpoints

Official Databricks SDK endpoint: GET /api/networking/v1/{parent}/endpoints

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/networking/v1/{parent}/endpoints';
    protected const PATH_PARAMS = array (
  'parent' => 'parent',
);
}
