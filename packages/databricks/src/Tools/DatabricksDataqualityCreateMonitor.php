<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dataquality Create Monitor.
 *
 * Maps to the official Databricks SDK endpoint post /api/data-quality/v1/monitors.
 */
class DatabricksDataqualityCreateMonitor extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dataquality_create_monitor';
    protected const DESCRIPTION = 'Dataquality Create Monitor

Official Databricks SDK endpoint: POST /api/data-quality/v1/monitors

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
    protected const PATH = '/api/data-quality/v1/monitors';
    protected const PATH_PARAMS = array (
);
}
