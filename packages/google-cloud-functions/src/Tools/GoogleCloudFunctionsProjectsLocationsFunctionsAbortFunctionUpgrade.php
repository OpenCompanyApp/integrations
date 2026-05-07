<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Functions Abort Function Upgrade.
 *
 * Maps to the official Cloud Functions endpoint POST /v2/{+name}:abortFunctionUpgrade.
 */
class GoogleCloudFunctionsProjectsLocationsFunctionsAbortFunctionUpgrade extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_functions_abort_function_upgrade';
    protected const DESCRIPTION = 'Projects Locations Functions Abort Function Upgrade

Official Cloud Functions endpoint: POST /v2/{+name}:abortFunctionUpgrade
Aborts generation upgrade process for a function with the given name from the specified project. Deletes all 2nd Gen copy related configuration and resources which were created during the upgrade process.';
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
    'description' => 'JSON request body matching the official Cloud Functions `AbortFunctionUpgradeRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+name}:abortFunctionUpgrade';
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
