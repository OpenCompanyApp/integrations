<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Cleanrooms Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/clean-rooms/{name}.
 */
class DatabricksCleanroomsDelete3 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_cleanrooms_delete_3';
    protected const DESCRIPTION = 'Cleanrooms Delete

Official Databricks SDK endpoint: DELETE /api/2.0/clean-rooms/{name}

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
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.0/clean-rooms/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
