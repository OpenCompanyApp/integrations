<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Log Logged Model Params.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/mlflow/logged-models/{model_id}/params.
 */
class DatabricksMlLogLoggedModelParams extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_log_logged_model_params';
    protected const DESCRIPTION = 'Ml Log Logged Model Params

Official Databricks SDK endpoint: POST /api/2.0/mlflow/logged-models/{model_id}/params

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'model_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `model_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/mlflow/logged-models/{model_id}/params';
    protected const PATH_PARAMS = array (
  'model_id' => 'model_id',
);
}
