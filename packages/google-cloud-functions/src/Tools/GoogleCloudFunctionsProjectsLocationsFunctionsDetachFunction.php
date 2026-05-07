<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Functions Detach Function.
 *
 * Maps to the official Cloud Functions endpoint POST /v2/{+name}:detachFunction.
 */
class GoogleCloudFunctionsProjectsLocationsFunctionsDetachFunction extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_functions_detach_function';
    protected const DESCRIPTION = 'Projects Locations Functions Detach Function

Official Cloud Functions endpoint: POST /v2/{+name}:detachFunction
Detaches 2nd Gen function to Cloud Run function.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Cloud Functions resource names such as `projects/example/locations/us-central1/functions/api`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Functions `DetachFunctionRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+name}:detachFunction';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
