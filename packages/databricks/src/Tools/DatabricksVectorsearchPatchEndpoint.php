<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Vectorsearch Patch Endpoint.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/vector-search/endpoints/{endpoint_name}.
 */
class DatabricksVectorsearchPatchEndpoint extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_vectorsearch_patch_endpoint';
    protected const DESCRIPTION = 'Vectorsearch Patch Endpoint

Official Databricks SDK endpoint: PATCH /api/2.0/vector-search/endpoints/{endpoint_name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'endpoint_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `endpoint_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/vector-search/endpoints/{endpoint_name}';
    protected const PATH_PARAMS = array (
  'endpoint_name' => 'endpoint_name',
);
}
