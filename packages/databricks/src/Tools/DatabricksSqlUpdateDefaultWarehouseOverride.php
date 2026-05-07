<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql Update Default Warehouse Override.
 *
 * Maps to the official Databricks SDK endpoint patch /api/warehouses/v1/{name}.
 */
class DatabricksSqlUpdateDefaultWarehouseOverride extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_update_default_warehouse_override';
    protected const DESCRIPTION = 'Sql Update Default Warehouse Override

Official Databricks SDK endpoint: PATCH /api/warehouses/v1/{name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/warehouses/v1/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
