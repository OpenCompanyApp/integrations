<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Delete Model Version Tag.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/mlflow/model-versions/delete-tag.
 */
class DatabricksMlDeleteModelVersionTag extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_delete_model_version_tag';
    protected const DESCRIPTION = 'Ml Delete Model Version Tag

Official Databricks SDK endpoint: DELETE /api/2.0/mlflow/model-versions/delete-tag

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
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.0/mlflow/model-versions/delete-tag';
    protected const PATH_PARAMS = array (
);
}
