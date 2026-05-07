<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Pipelines List Pipeline Events.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/pipelines/{pipeline_id}/events.
 */
class DatabricksPipelinesListPipelineEvents extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_pipelines_list_pipeline_events';
    protected const DESCRIPTION = 'Pipelines List Pipeline Events

Official Databricks SDK endpoint: GET /api/2.0/pipelines/{pipeline_id}/events

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/pipelines/{pipeline_id}/events';
    protected const PATH_PARAMS = array (
  'pipeline_id' => 'pipeline_id',
);
}
