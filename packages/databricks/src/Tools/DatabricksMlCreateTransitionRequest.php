<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Create Transition Request.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/mlflow/transition-requests/create.
 */
class DatabricksMlCreateTransitionRequest extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_create_transition_request';
    protected const DESCRIPTION = 'Ml Create Transition Request

Official Databricks SDK endpoint: POST /api/2.0/mlflow/transition-requests/create

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
    protected const PATH = '/api/2.0/mlflow/transition-requests/create';
    protected const PATH_PARAMS = array (
);
}
