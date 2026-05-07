<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Jobs Cancel.
 *
 * Maps to the official BigQuery endpoint POST /projects/{+projectId}/jobs/{+jobId}/cancel.
 */
class GoogleBigQueryJobsCancel extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_jobs_cancel';
    protected const DESCRIPTION = 'Jobs Cancel

Official BigQuery endpoint: POST /projects/{+projectId}/jobs/{+jobId}/cancel
Requests that a job be cancelled. This call will return immediately, and the client will need to poll for the job status to see if the cancel completed successfully. Cancelled jobs may still incur costs.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/projects/{+projectId}/jobs/{+jobId}/cancel';
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
