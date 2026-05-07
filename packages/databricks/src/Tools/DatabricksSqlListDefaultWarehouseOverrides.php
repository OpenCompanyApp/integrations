<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql List Default Warehouse Overrides.
 *
 * Maps to the official Databricks SDK endpoint get /api/warehouses/v1/default-warehouse-overrides.
 */
class DatabricksSqlListDefaultWarehouseOverrides extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_list_default_warehouse_overrides';
    protected const DESCRIPTION = 'Sql List Default Warehouse Overrides

Official Databricks SDK endpoint: GET /api/warehouses/v1/default-warehouse-overrides

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
    protected const PATH = '/api/warehouses/v1/default-warehouse-overrides';
    protected const PATH_PARAMS = array (
);
}
