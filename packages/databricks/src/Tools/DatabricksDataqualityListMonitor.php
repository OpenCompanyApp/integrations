<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dataquality List Monitor.
 *
 * Maps to the official Databricks SDK endpoint get /api/data-quality/v1/monitors.
 */
class DatabricksDataqualityListMonitor extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dataquality_list_monitor';
    protected const DESCRIPTION = 'Dataquality List Monitor

Official Databricks SDK endpoint: GET /api/data-quality/v1/monitors

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
    protected const PATH = '/api/data-quality/v1/monitors';
    protected const PATH_PARAMS = array (
);
}
