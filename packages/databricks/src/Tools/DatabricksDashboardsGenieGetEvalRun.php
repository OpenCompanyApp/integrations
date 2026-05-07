<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dashboards Genie Get Eval Run.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/genie/spaces/{space_id}/eval-runs/{eval_run_id}.
 */
class DatabricksDashboardsGenieGetEvalRun extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dashboards_genie_get_eval_run';
    protected const DESCRIPTION = 'Dashboards Genie Get Eval Run

Official Databricks SDK endpoint: GET /api/2.0/genie/spaces/{space_id}/eval-runs/{eval_run_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'space_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `space_id` from the Databricks SDK endpoint.',
  ),
  'eval_run_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `eval_run_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/genie/spaces/{space_id}/eval-runs/{eval_run_id}';
    protected const PATH_PARAMS = array (
  'space_id' => 'space_id',
  'eval_run_id' => 'eval_run_id',
);
}
