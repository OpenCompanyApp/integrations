<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Jobs Query.
 *
 * Maps to the official BigQuery endpoint POST /projects/{+projectId}/queries.
 */
class GoogleBigQueryJobsQuery extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_jobs_query';
    protected const DESCRIPTION = 'Jobs Query

Official BigQuery endpoint: POST /projects/{+projectId}/queries
Runs a BigQuery SQL query synchronously and returns query results if the query completes within a specified timeout.';
    protected const PARAMETERS = array (
  'projectId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `QueryRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/projects/{+projectId}/queries';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
