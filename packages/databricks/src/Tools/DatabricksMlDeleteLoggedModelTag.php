<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Delete Logged Model Tag.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/mlflow/logged-models/{model_id}/tags/{tag_key}.
 */
class DatabricksMlDeleteLoggedModelTag extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_delete_logged_model_tag';
    protected const DESCRIPTION = 'Ml Delete Logged Model Tag

Official Databricks SDK endpoint: DELETE /api/2.0/mlflow/logged-models/{model_id}/tags/{tag_key}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'model_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `model_id` from the Databricks SDK endpoint.',
  ),
  'tag_key' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tag_key` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.0/mlflow/logged-models/{model_id}/tags/{tag_key}';
    protected const PATH_PARAMS = array (
  'model_id' => 'model_id',
  'tag_key' => 'tag_key',
);
}
