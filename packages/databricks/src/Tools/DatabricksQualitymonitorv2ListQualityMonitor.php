<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Qualitymonitorv2 List Quality Monitor.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/quality-monitors.
 */
class DatabricksQualitymonitorv2ListQualityMonitor extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_qualitymonitorv2_list_quality_monitor';
    protected const DESCRIPTION = 'Qualitymonitorv2 List Quality Monitor

Official Databricks SDK endpoint: GET /api/2.0/quality-monitors

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
    protected const PATH = '/api/2.0/quality-monitors';
    protected const PATH_PARAMS = array (
);
}
