<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Get Model Version Download Uri.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/mlflow/model-versions/get-download-uri.
 */
class DatabricksMlGetModelVersionDownloadUri extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_get_model_version_download_uri';
    protected const DESCRIPTION = 'Ml Get Model Version Download Uri

Official Databricks SDK endpoint: GET /api/2.0/mlflow/model-versions/get-download-uri

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
    protected const PATH = '/api/2.0/mlflow/model-versions/get-download-uri';
    protected const PATH_PARAMS = array (
);
}
