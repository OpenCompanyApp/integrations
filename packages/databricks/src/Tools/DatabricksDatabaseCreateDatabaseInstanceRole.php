<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Database Create Database Instance Role.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/database/instances/{instance_name}/roles.
 */
class DatabricksDatabaseCreateDatabaseInstanceRole extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_database_create_database_instance_role';
    protected const DESCRIPTION = 'Database Create Database Instance Role

Official Databricks SDK endpoint: POST /api/2.0/database/instances/{instance_name}/roles

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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.0/database/instances/{instance_name}/roles';
    protected const PATH_PARAMS = array (
  'instance_name' => 'instance_name',
);
}
