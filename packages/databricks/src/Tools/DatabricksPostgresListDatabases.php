<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Postgres List Databases.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/postgres/{parent}/databases.
 */
class DatabricksPostgresListDatabases extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_postgres_list_databases';
    protected const DESCRIPTION = 'Postgres List Databases

Official Databricks SDK endpoint: GET /api/2.0/postgres/{parent}/databases

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
    protected const PATH = '/api/2.0/postgres/{parent}/databases';
    protected const PATH_PARAMS = array (
  'parent' => 'parent',
);
}
