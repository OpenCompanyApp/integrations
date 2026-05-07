<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Jobs List Runs.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.2/jobs/runs/list.
 */
class DatabricksJobsListRuns extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_jobs_list_runs';
    protected const DESCRIPTION = 'Jobs List Runs

Official Databricks SDK endpoint: GET /api/2.2/jobs/runs/list

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
    protected const PATH = '/api/2.2/jobs/runs/list';
    protected const PATH_PARAMS = array (
);
}
