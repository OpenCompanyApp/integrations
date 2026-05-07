<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Functions Rollback Function Upgrade Traffic.
 *
 * Maps to the official Cloud Functions endpoint POST /v2/{+name}:rollbackFunctionUpgradeTraffic.
 */
class GoogleCloudFunctionsProjectsLocationsFunctionsRollbackFunctionUpgradeTraffic extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_functions_rollback_function_upgrade_traffic';
    protected const DESCRIPTION = 'Projects Locations Functions Rollback Function Upgrade Traffic

Official Cloud Functions endpoint: POST /v2/{+name}:rollbackFunctionUpgradeTraffic
Reverts the traffic target of a function from the 2nd Gen copy to the original 1st Gen function. After this operation, all new traffic would be served by the 1st Gen.';
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
    'description' => 'JSON request body matching the official Cloud Functions `RollbackFunctionUpgradeTrafficRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+name}:rollbackFunctionUpgradeTraffic';
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
