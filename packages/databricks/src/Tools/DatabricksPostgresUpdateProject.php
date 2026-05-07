<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Postgres Update Project.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/postgres/{name}.
 */
class DatabricksPostgresUpdateProject extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_postgres_update_project';
    protected const DESCRIPTION = 'Postgres Update Project

Official Databricks SDK endpoint: PATCH /api/2.0/postgres/{name}

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
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.0/postgres/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
