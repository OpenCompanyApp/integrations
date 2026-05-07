<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml List Transition Requests.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/mlflow/transition-requests/list.
 */
class DatabricksMlListTransitionRequests extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_list_transition_requests';
    protected const DESCRIPTION = 'Ml List Transition Requests

Official Databricks SDK endpoint: GET /api/2.0/mlflow/transition-requests/list

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
    protected const PATH = '/api/2.0/mlflow/transition-requests/list';
    protected const PATH_PARAMS = array (
);
}
