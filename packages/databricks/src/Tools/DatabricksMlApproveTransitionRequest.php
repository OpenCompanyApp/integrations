<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Approve Transition Request.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/mlflow/transition-requests/approve.
 */
class DatabricksMlApproveTransitionRequest extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_approve_transition_request';
    protected const DESCRIPTION = 'Ml Approve Transition Request

Official Databricks SDK endpoint: POST /api/2.0/mlflow/transition-requests/approve

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
    protected const PATH = '/api/2.0/mlflow/transition-requests/approve';
    protected const PATH_PARAMS = array (
);
}
