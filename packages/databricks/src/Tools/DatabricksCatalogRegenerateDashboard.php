<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Regenerate Dashboard.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.1/quality-monitoring/tables/{table_name}/monitor/dashboard.
 */
class DatabricksCatalogRegenerateDashboard extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_regenerate_dashboard';
    protected const DESCRIPTION = 'Catalog Regenerate Dashboard

Official Databricks SDK endpoint: POST /api/2.1/quality-monitoring/tables/{table_name}/monitor/dashboard

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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.1/quality-monitoring/tables/{table_name}/monitor/dashboard';
    protected const PATH_PARAMS = array (
  'table_name' => 'table_name',
);
}
