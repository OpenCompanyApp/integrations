<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Adaptive Mt Datasets List.
 *
 * Maps to the official Cloud Translation endpoint GET /v3/{+parent}/adaptiveMtDatasets.
 */
class GoogleTranslateProjectsLocationsAdaptiveMtDatasetsList extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_adaptive_mt_datasets_list';
    protected const DESCRIPTION = 'Projects Locations Adaptive Mt Datasets List

Official Google Cloud Translation endpoint: GET /v3/{+parent}/adaptiveMtDatasets
Lists all Adaptive MT datasets for which the caller has read permission.';
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
    'description' => 'Query string parameters accepted by the official Cloud Translation method. Known keys: pageToken, filter, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A token identifying a page of results the server should return. Typically, this is the value of ListAdaptiveMtDatasetsResponse.next_page_token returned from the previous call to `ListAdaptiveMtDatasets` method. The first page is returned if `page_token`is empty or missing.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. An expression for filtering the results of the request. Filter is not supported yet.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. Requested page size. The server may return fewer results than requested. If unspecified, the server picks an appropriate default.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v3/{+parent}/adaptiveMtDatasets';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'filter',
  2 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
