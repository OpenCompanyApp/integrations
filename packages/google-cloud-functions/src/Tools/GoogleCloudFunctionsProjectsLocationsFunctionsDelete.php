<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Functions Delete.
 *
 * Maps to the official Cloud Functions endpoint DELETE /v2/{+name}.
 */
class GoogleCloudFunctionsProjectsLocationsFunctionsDelete extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_functions_delete';
    protected const DESCRIPTION = 'Projects Locations Functions Delete

Official Cloud Functions endpoint: DELETE /v2/{+name}
Deletes a function with the given name from the specified project. If the given function is used by some trigger, the trigger will be updated to remove this function.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Cloud Functions resource names such as `projects/example/locations/us-central1/functions/api`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
