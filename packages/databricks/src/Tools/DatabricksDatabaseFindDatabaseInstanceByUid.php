<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Database Find Database Instance By Uid.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/database/instances:findByUid.
 */
class DatabricksDatabaseFindDatabaseInstanceByUid extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_database_find_database_instance_by_uid';
    protected const DESCRIPTION = 'Database Find Database Instance By Uid

Official Databricks SDK endpoint: GET /api/2.0/database/instances:findByUid

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/database/instances:findByUid';
    protected const PATH_PARAMS = array (
);
}
