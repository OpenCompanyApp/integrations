<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Runtimes List.
 *
 * Maps to the official Cloud Functions endpoint GET /v2/{+parent}/runtimes.
 */
class GoogleCloudFunctionsProjectsLocationsRuntimesList extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_runtimes_list';
    protected const DESCRIPTION = 'Projects Locations Runtimes List

Official Cloud Functions endpoint: GET /v2/{+parent}/runtimes
Returns a list of runtimes that are supported for the requested project.';
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
    'description' => 'Query string parameters accepted by the official Cloud Functions method. Known keys: filter.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{+parent}/runtimes';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'filter',
);
    protected const BODY_REQUIRED = false;
}
