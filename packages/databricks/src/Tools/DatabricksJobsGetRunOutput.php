<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Jobs Get Run Output.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.2/jobs/runs/get-output.
 */
class DatabricksJobsGetRunOutput extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_jobs_get_run_output';
    protected const DESCRIPTION = 'Jobs Get Run Output

Official Databricks SDK endpoint: GET /api/2.2/jobs/runs/get-output

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
    protected const PATH = '/api/2.2/jobs/runs/get-output';
    protected const PATH_PARAMS = array (
);
}
