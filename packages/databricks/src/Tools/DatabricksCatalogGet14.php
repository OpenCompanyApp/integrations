<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/unity-catalog/tables/{table_name}/monitor.
 */
class DatabricksCatalogGet14 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_get_14';
    protected const DESCRIPTION = 'Catalog Get

Official Databricks SDK endpoint: GET /api/2.1/unity-catalog/tables/{table_name}/monitor

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.1/unity-catalog/tables/{table_name}/monitor';
    protected const PATH_PARAMS = array (
  'table_name' => 'table_name',
);
}
