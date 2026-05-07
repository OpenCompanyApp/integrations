<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Jobs List.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/jobs.
 */
class GoogleBigQueryJobsList extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_jobs_list';
    protected const DESCRIPTION = 'Jobs List

Official BigQuery endpoint: GET /projects/{+projectId}/jobs
Lists all jobs that you started in the specified project. Job information is available for a six month period after creation. The job list is sorted in reverse chronological order, by job creation time. Requires the Can View project role, or the Is Owner project role if you set the allUsers property.';
    protected const PARAMETERS = array (
  'projectId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectId`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: allUsers, maxCreationTime, maxResults, minCreationTime, pageToken, parentJobId, projection, stateFilter.',
  ),
  'allUsers' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `allUsers`.',
  ),
  'maxCreationTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxCreationTime`.',
  ),
  'maxResults' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxResults`.',
  ),
  'minCreationTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `minCreationTime`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'parentJobId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `parentJobId`.',
  ),
  'projection' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `projection`.',
  ),
  'stateFilter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `stateFilter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/projects/{+projectId}/jobs';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const QUERY_KEYS = array (
  0 => 'allUsers',
  1 => 'maxCreationTime',
  2 => 'maxResults',
  3 => 'minCreationTime',
  4 => 'pageToken',
  5 => 'parentJobId',
  6 => 'projection',
  7 => 'stateFilter',
);
    protected const BODY_REQUIRED = false;
}
