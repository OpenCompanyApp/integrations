<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Datasets List.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/datasets.
 */
class GoogleBigQueryDatasetsList extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_datasets_list';
    protected const DESCRIPTION = 'Datasets List

Official BigQuery endpoint: GET /projects/{+projectId}/datasets
Lists all datasets in the specified project to which the user has been granted the READER dataset role.';
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
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: all, filter, maxResults, pageToken.',
  ),
  'all' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `all`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/projects/{+projectId}/datasets';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const QUERY_KEYS = array (
  0 => 'all',
  1 => 'filter',
  2 => 'maxResults',
  3 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
