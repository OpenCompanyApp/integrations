<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Set Logged Model Tags.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/mlflow/logged-models/{model_id}/tags.
 */
class DatabricksMlSetLoggedModelTags extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_set_logged_model_tags';
    protected const DESCRIPTION = 'Ml Set Logged Model Tags

Official Databricks SDK endpoint: PATCH /api/2.0/mlflow/logged-models/{model_id}/tags

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
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.0/mlflow/logged-models/{model_id}/tags';
    protected const PATH_PARAMS = array (
  'model_id' => 'model_id',
);
}
