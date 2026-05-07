<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Create Model Version.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/mlflow/model-versions/create.
 */
class DatabricksMlCreateModelVersion extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_create_model_version';
    protected const DESCRIPTION = 'Ml Create Model Version

Official Databricks SDK endpoint: POST /api/2.0/mlflow/model-versions/create

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
    protected const PATH = '/api/2.0/mlflow/model-versions/create';
    protected const PATH_PARAMS = array (
);
}
