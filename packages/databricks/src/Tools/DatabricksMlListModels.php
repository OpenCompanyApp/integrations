<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml List Models.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/mlflow/registered-models/list.
 */
class DatabricksMlListModels extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_list_models';
    protected const DESCRIPTION = 'Ml List Models

Official Databricks SDK endpoint: GET /api/2.0/mlflow/registered-models/list

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
    protected const PATH = '/api/2.0/mlflow/registered-models/list';
    protected const PATH_PARAMS = array (
);
}
