<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settings Get Enable Export Notebook.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/settings/types/enable-export-notebook/names/default.
 */
class DatabricksSettingsGetEnableExportNotebook extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settings_get_enable_export_notebook';
    protected const DESCRIPTION = 'Settings Get Enable Export Notebook

Official Databricks SDK endpoint: GET /api/2.0/settings/types/enable-export-notebook/names/default

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
    protected const PATH = '/api/2.0/settings/types/enable-export-notebook/names/default';
    protected const PATH_PARAMS = array (
);
}
