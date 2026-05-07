<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Functions List.
 *
 * Maps to the official Cloud Functions endpoint GET /v2/{+parent}/functions.
 */
class GoogleCloudFunctionsProjectsLocationsFunctionsList extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_functions_list';
    protected const DESCRIPTION = 'Projects Locations Functions List

Official Cloud Functions endpoint: GET /v2/{+parent}/functions
Returns a list of functions that belong to the requested project.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Cloud Functions resource names such as `projects/example/locations/us-central1/functions/api`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Functions method. Known keys: pageSize, filter, pageToken, orderBy.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderBy`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{+parent}/functions';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'filter',
  2 => 'pageToken',
  3 => 'orderBy',
);
    protected const BODY_REQUIRED = false;
}
