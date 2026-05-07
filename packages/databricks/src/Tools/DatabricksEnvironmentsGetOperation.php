<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Environments Get Operation.
 *
 * Maps to the official Databricks SDK endpoint get /api/environments/v1/{name}.
 */
class DatabricksEnvironmentsGetOperation extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_environments_get_operation';
    protected const DESCRIPTION = 'Environments Get Operation

Official Databricks SDK endpoint: GET /api/environments/v1/{name}

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
    protected const PATH = '/api/environments/v1/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
