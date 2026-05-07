<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Cancel Refresh.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.1/unity-catalog/tables/{table_name}/monitor/refreshes/{refresh_id}/cancel.
 */
class DatabricksCatalogCancelRefresh extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_cancel_refresh';
    protected const DESCRIPTION = 'Catalog Cancel Refresh

Official Databricks SDK endpoint: POST /api/2.1/unity-catalog/tables/{table_name}/monitor/refreshes/{refresh_id}/cancel

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `table_name` from the Databricks SDK endpoint.',
  ),
  'refresh_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `refresh_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/unity-catalog/tables/{table_name}/monitor/refreshes/{refresh_id}/cancel';
    protected const PATH_PARAMS = array (
  'table_name' => 'table_name',
  'refresh_id' => 'refresh_id',
);
}
