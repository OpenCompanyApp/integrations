<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql Set Workspace Warehouse Config.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/sql/config/warehouses.
 */
class DatabricksSqlSetWorkspaceWarehouseConfig extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_set_workspace_warehouse_config';
    protected const DESCRIPTION = 'Sql Set Workspace Warehouse Config

Official Databricks SDK endpoint: PUT /api/2.0/sql/config/warehouses

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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.0/sql/config/warehouses';
    protected const PATH_PARAMS = array (
);
}
