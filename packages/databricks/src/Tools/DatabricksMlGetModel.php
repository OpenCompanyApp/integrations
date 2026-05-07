<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Get Model.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/mlflow/databricks/registered-models/get.
 */
class DatabricksMlGetModel extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_get_model';
    protected const DESCRIPTION = 'Ml Get Model

Official Databricks SDK endpoint: GET /api/2.0/mlflow/databricks/registered-models/get

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
    protected const PATH = '/api/2.0/mlflow/databricks/registered-models/get';
    protected const PATH_PARAMS = array (
);
}
