<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Functions Get.
 *
 * Maps to the official Cloud Functions endpoint GET /v2/{+name}.
 */
class GoogleCloudFunctionsProjectsLocationsFunctionsGet extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_functions_get';
    protected const DESCRIPTION = 'Projects Locations Functions Get

Official Cloud Functions endpoint: GET /v2/{+name}
Returns a function with the given name from the requested project.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Cloud Functions resource names such as `projects/example/locations/us-central1/functions/api`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Functions method. Known keys: revision.',
  ),
  'revision' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `revision`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'revision',
);
    protected const BODY_REQUIRED = false;
}
