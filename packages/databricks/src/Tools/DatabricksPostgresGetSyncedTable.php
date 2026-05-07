<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Postgres Get Synced Table.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/postgres/{name}.
 */
class DatabricksPostgresGetSyncedTable extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_postgres_get_synced_table';
    protected const DESCRIPTION = 'Postgres Get Synced Table

Official Databricks SDK endpoint: GET /api/2.0/postgres/{name}

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
    protected const PATH = '/api/2.0/postgres/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
