<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Database List Database Catalogs.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/database/instances/{instance_name}/catalogs.
 */
class DatabricksDatabaseListDatabaseCatalogs extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_database_list_database_catalogs';
    protected const DESCRIPTION = 'Database List Database Catalogs

Official Databricks SDK endpoint: GET /api/2.0/database/instances/{instance_name}/catalogs

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'instance_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `instance_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/database/instances/{instance_name}/catalogs';
    protected const PATH_PARAMS = array (
  'instance_name' => 'instance_name',
);
}
