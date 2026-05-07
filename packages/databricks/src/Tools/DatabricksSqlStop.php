<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql Stop.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/sql/warehouses/{id}/stop.
 */
class DatabricksSqlStop extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_stop';
    protected const DESCRIPTION = 'Sql Stop

Official Databricks SDK endpoint: POST /api/2.0/sql/warehouses/{id}/stop

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.0/sql/warehouses/{id}/stop';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
}
