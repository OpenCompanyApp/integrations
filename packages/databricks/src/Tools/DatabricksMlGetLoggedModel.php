<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Get Logged Model.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/mlflow/logged-models/{model_id}.
 */
class DatabricksMlGetLoggedModel extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_get_logged_model';
    protected const DESCRIPTION = 'Ml Get Logged Model

Official Databricks SDK endpoint: GET /api/2.0/mlflow/logged-models/{model_id}

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/mlflow/logged-models/{model_id}';
    protected const PATH_PARAMS = array (
  'model_id' => 'model_id',
);
}
