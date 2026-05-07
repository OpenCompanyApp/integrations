<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Jobs Get Query Results.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/queries/{+jobId}.
 */
class GoogleBigQueryJobsGetQueryResults extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_jobs_get_query_results';
    protected const DESCRIPTION = 'Jobs Get Query Results

Official BigQuery endpoint: GET /projects/{+projectId}/queries/{+jobId}
RPC to get the results of a query job.';
    protected const PARAMETERS = array (
  'projectId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectId`.',
  ),
  'jobId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `jobId`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: formatOptions.timestampOutputFormat, formatOptions.useInt64Timestamp, location, maxResults, pageToken, startIndex, timeoutMs.',
  ),
  'formatOptions.timestampOutputFormat' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `formatOptions.timestampOutputFormat`.',
  ),
  'formatOptions.useInt64Timestamp' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `formatOptions.useInt64Timestamp`.',
  ),
  'location' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `location`.',
  ),
  'maxResults' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxResults`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'startIndex' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `startIndex`.',
  ),
  'timeoutMs' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `timeoutMs`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/projects/{+projectId}/queries/{+jobId}';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'jobId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'jobId',
);
    protected const QUERY_KEYS = array (
  0 => 'formatOptions.timestampOutputFormat',
  1 => 'formatOptions.useInt64Timestamp',
  2 => 'location',
  3 => 'maxResults',
  4 => 'pageToken',
  5 => 'startIndex',
  6 => 'timeoutMs',
);
    protected const BODY_REQUIRED = false;
}
