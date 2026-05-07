<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Update.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.1/unity-catalog/tables/{table_name}/monitor.
 */
class DatabricksCatalogUpdate13 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_update_13';
    protected const DESCRIPTION = 'Catalog Update

Official Databricks SDK endpoint: PUT /api/2.1/unity-catalog/tables/{table_name}/monitor

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `table_name` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.1/unity-catalog/tables/{table_name}/monitor';
    protected const PATH_PARAMS = array (
  'table_name' => 'table_name',
);
}
