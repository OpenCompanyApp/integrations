<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql Create.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/sql/visualizations.
 */
class DatabricksSqlCreate6 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_create_6';
    protected const DESCRIPTION = 'Sql Create

Official Databricks SDK endpoint: POST /api/2.0/sql/visualizations

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
    protected const PATH = '/api/2.0/sql/visualizations';
    protected const PATH_PARAMS = array (
);
}
