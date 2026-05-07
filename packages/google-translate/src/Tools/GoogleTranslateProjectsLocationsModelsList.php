<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Models List.
 *
 * Maps to the official Cloud Translation endpoint GET /v3/{+parent}/models.
 */
class GoogleTranslateProjectsLocationsModelsList extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_models_list';
    protected const DESCRIPTION = 'Projects Locations Models List

Official Google Cloud Translation endpoint: GET /v3/{+parent}/models
Lists models.';
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
    'description' => 'Query string parameters accepted by the official Cloud Translation method. Known keys: filter, pageToken, pageSize.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. An expression for filtering the models that will be returned. Supported filter: `dataset_id=${dataset_id}`',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A token identifying a page of results for the server to return. Typically obtained from next_page_token field in the response of a ListModels call.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. Requested page size. The server can return fewer results than requested.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v3/{+parent}/models';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'filter',
  1 => 'pageToken',
  2 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
