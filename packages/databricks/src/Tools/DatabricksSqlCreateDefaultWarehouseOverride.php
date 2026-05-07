<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql Create Default Warehouse Override.
 *
 * Maps to the official Databricks SDK endpoint post /api/warehouses/v1/default-warehouse-overrides.
 */
class DatabricksSqlCreateDefaultWarehouseOverride extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_create_default_warehouse_override';
    protected const DESCRIPTION = 'Sql Create Default Warehouse Override

Official Databricks SDK endpoint: POST /api/warehouses/v1/default-warehouse-overrides

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
    protected const PATH = '/api/warehouses/v1/default-warehouse-overrides';
    protected const PATH_PARAMS = array (
);
}
