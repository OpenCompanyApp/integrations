<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Functions Redirect Function Upgrade Traffic.
 *
 * Maps to the official Cloud Functions endpoint POST /v2/{+name}:redirectFunctionUpgradeTraffic.
 */
class GoogleCloudFunctionsProjectsLocationsFunctionsRedirectFunctionUpgradeTraffic extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_functions_redirect_function_upgrade_traffic';
    protected const DESCRIPTION = 'Projects Locations Functions Redirect Function Upgrade Traffic

Official Cloud Functions endpoint: POST /v2/{+name}:redirectFunctionUpgradeTraffic
Changes the traffic target of a function from the original 1st Gen function to the 2nd Gen copy. This is the second step of the multi step process to upgrade 1st Gen functions to 2nd Gen. After this operation, all new traffic will be served by 2nd Gen copy.';
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
    'description' => 'JSON request body matching the official Cloud Functions `RedirectFunctionUpgradeTrafficRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+name}:redirectFunctionUpgradeTraffic';
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
