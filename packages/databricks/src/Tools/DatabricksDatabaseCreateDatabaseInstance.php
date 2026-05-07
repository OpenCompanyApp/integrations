<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Database Create Database Instance.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/database/instances.
 */
class DatabricksDatabaseCreateDatabaseInstance extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_database_create_database_instance';
    protected const DESCRIPTION = 'Database Create Database Instance

Official Databricks SDK endpoint: POST /api/2.0/database/instances

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/2.0/database/instances';
    protected const PATH_PARAMS = array (
);
}
