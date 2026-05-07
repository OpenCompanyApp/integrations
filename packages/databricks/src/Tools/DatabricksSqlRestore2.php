<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql Restore.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/preview/sql/queries/trash/{query_id}.
 */
class DatabricksSqlRestore2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_restore_2';
    protected const DESCRIPTION = 'Sql Restore

Official Databricks SDK endpoint: POST /api/2.0/preview/sql/queries/trash/{query_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'query_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `query_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/preview/sql/queries/trash/{query_id}';
    protected const PATH_PARAMS = array (
  'query_id' => 'query_id',
);
}
