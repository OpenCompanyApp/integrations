<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Jobs Get.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/jobs/{+jobId}.
 */
class GoogleBigQueryJobsGet extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_jobs_get';
    protected const DESCRIPTION = 'Jobs Get

Official BigQuery endpoint: GET /projects/{+projectId}/jobs/{+jobId}
Returns information about a specific job. Job information is available for a six month period after creation. Requires that you\'re the person who ran the job, or have the Is Owner project role.';
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
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: location.',
  ),
  'location' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `location`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/projects/{+projectId}/jobs/{+jobId}';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'jobId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'jobId',
);
    protected const QUERY_KEYS = array (
  0 => 'location',
);
    protected const BODY_REQUIRED = false;
}
