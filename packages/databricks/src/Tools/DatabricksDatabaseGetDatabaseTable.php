<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Database Get Database Table.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/database/tables/{name}.
 */
class DatabricksDatabaseGetDatabaseTable extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_database_get_database_table';
    protected const DESCRIPTION = 'Database Get Database Table

Official Databricks SDK endpoint: GET /api/2.0/database/tables/{name}

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
    protected const PATH = '/api/2.0/database/tables/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
