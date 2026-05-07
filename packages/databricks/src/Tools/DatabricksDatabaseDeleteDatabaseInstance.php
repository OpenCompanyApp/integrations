<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Database Delete Database Instance.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/database/instances/{name}.
 */
class DatabricksDatabaseDeleteDatabaseInstance extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_database_delete_database_instance';
    protected const DESCRIPTION = 'Database Delete Database Instance

Official Databricks SDK endpoint: DELETE /api/2.0/database/instances/{name}

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
    protected const PATH = '/api/2.0/database/instances/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
