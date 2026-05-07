<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/preview/sql/dashboards/{dashboard_id}.
 */
class DatabricksSqlDelete4 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_delete_4';
    protected const DESCRIPTION = 'Sql Delete

Official Databricks SDK endpoint: DELETE /api/2.0/preview/sql/dashboards/{dashboard_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'dashboard_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dashboard_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/preview/sql/dashboards/{dashboard_id}';
    protected const PATH_PARAMS = array (
  'dashboard_id' => 'dashboard_id',
);
}
