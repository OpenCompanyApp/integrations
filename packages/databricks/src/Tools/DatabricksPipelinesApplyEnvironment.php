<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Pipelines Apply Environment.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/pipelines/{pipeline_id}/environment/apply.
 */
class DatabricksPipelinesApplyEnvironment extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_pipelines_apply_environment';
    protected const DESCRIPTION = 'Pipelines Apply Environment

Official Databricks SDK endpoint: POST /api/2.0/pipelines/{pipeline_id}/environment/apply

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'pipeline_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `pipeline_id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.0/pipelines/{pipeline_id}/environment/apply';
    protected const PATH_PARAMS = array (
  'pipeline_id' => 'pipeline_id',
);
}
