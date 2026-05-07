<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Jobs Delete.
 *
 * Maps to the official BigQuery endpoint DELETE /projects/{+projectId}/jobs/{+jobId}/delete.
 */
class GoogleBigQueryJobsDelete extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_jobs_delete';
    protected const DESCRIPTION = 'Jobs Delete

Official BigQuery endpoint: DELETE /projects/{+projectId}/jobs/{+jobId}/delete
Requests the deletion of the metadata of a job. This call returns when the job\'s metadata is deleted.';
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
    protected const METHOD = 'DELETE';
    protected const PATH = '/projects/{+projectId}/jobs/{+jobId}/delete';
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
