<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Functions Setup Function Upgrade Config.
 *
 * Maps to the official Cloud Functions endpoint POST /v2/{+name}:setupFunctionUpgradeConfig.
 */
class GoogleCloudFunctionsProjectsLocationsFunctionsSetupFunctionUpgradeConfig extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_functions_setup_function_upgrade_config';
    protected const DESCRIPTION = 'Projects Locations Functions Setup Function Upgrade Config

Official Cloud Functions endpoint: POST /v2/{+name}:setupFunctionUpgradeConfig
Creates a 2nd Gen copy of the function configuration based on the 1st Gen function with the given name. This is the first step of the multi step process to upgrade 1st Gen functions to 2nd Gen. Only 2nd Gen configuration is setup as part of this request and traffic continues to be served by 1st Gen.';
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
    'description' => 'JSON request body matching the official Cloud Functions `SetupFunctionUpgradeConfigRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+name}:setupFunctionUpgradeConfig';
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
