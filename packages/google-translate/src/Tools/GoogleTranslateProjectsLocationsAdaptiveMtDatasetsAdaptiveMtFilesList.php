<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Adaptive Mt Datasets Adaptive Mt Files List.
 *
 * Maps to the official Cloud Translation endpoint GET /v3/{+parent}/adaptiveMtFiles.
 */
class GoogleTranslateProjectsLocationsAdaptiveMtDatasetsAdaptiveMtFilesList extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_adaptive_mt_datasets_adaptive_mt_files_list';
    protected const DESCRIPTION = 'Projects Locations Adaptive Mt Datasets Adaptive Mt Files List

Official Google Cloud Translation endpoint: GET /v3/{+parent}/adaptiveMtFiles
Lists all AdaptiveMtFiles associated to an AdaptiveMtDataset.';
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
    'description' => 'Optional.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A token identifying a page of results the server should return. Typically, this is the value of ListAdaptiveMtFilesResponse.next_page_token returned from the previous call to `ListAdaptiveMtFiles` method. The first page is returned if `page_token`is empty or missing.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v3/{+parent}/adaptiveMtFiles';
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
