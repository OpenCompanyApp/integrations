<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Datasets List.
 *
 * Maps to the official Cloud Translation endpoint GET /v3/{+parent}/datasets.
 */
class GoogleTranslateProjectsLocationsDatasetsList extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_datasets_list';
    protected const DESCRIPTION = 'Projects Locations Datasets List

Official Google Cloud Translation endpoint: GET /v3/{+parent}/datasets
Lists datasets.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the official Cloud Translation API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Translation method. Known keys: pageSize, pageToken.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. Requested page size. The server can return fewer results than requested.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A token identifying a page of results for the server to return. Typically obtained from next_page_token field in the response of a ListDatasets call.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v3/{+parent}/datasets';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
