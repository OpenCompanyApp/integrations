<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql Get Workspace Warehouse Config.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/sql/config/warehouses.
 */
class DatabricksSqlGetWorkspaceWarehouseConfig extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_get_workspace_warehouse_config';
    protected const DESCRIPTION = 'Sql Get Workspace Warehouse Config

Official Databricks SDK endpoint: GET /api/2.0/sql/config/warehouses

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
    protected const PATH = '/api/2.0/sql/config/warehouses';
    protected const PATH_PARAMS = array (
);
}
