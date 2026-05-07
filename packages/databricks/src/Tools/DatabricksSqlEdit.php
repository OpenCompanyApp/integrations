<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql Edit.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/sql/warehouses/{id}/edit.
 */
class DatabricksSqlEdit extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_edit';
    protected const DESCRIPTION = 'Sql Edit

Official Databricks SDK endpoint: POST /api/2.0/sql/warehouses/{id}/edit

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/sql/warehouses/{id}/edit';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
}
