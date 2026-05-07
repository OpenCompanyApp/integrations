<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Serving Build Logs.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/serving-endpoints/{name}/served-models/{served_model_name}/build-logs.
 */
class DatabricksServingBuildLogs extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_serving_build_logs';
    protected const DESCRIPTION = 'Serving Build Logs

Official Databricks SDK endpoint: GET /api/2.0/serving-endpoints/{name}/served-models/{served_model_name}/build-logs

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the Databricks SDK endpoint.',
  ),
  'served_model_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `served_model_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/serving-endpoints/{name}/served-models/{served_model_name}/build-logs';
    protected const PATH_PARAMS = array (
  'name' => 'name',
  'served_model_name' => 'served_model_name',
);
}
