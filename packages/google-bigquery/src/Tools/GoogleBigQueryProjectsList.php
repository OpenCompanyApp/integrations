<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Projects List.
 *
 * Maps to the official BigQuery endpoint GET /projects.
 */
class GoogleBigQueryProjectsList extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_projects_list';
    protected const DESCRIPTION = 'Projects List

Official BigQuery endpoint: GET /projects
RPC to list projects to which the user has been granted any project role. Users of this method are encouraged to consider the [Resource Manager](https://cloud.google.com/resource-manager/docs/) API, which provides the underlying data for this method and has more capabilities.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: maxResults, pageToken.',
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
    protected const PATH = '/projects';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'maxResults',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
