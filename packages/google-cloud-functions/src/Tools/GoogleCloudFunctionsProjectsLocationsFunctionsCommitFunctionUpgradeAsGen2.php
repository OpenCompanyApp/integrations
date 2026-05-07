<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Functions Commit Function Upgrade As Gen2.
 *
 * Maps to the official Cloud Functions endpoint POST /v2/{+name}:commitFunctionUpgradeAsGen2.
 */
class GoogleCloudFunctionsProjectsLocationsFunctionsCommitFunctionUpgradeAsGen2 extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_functions_commit_function_upgrade_as_gen2';
    protected const DESCRIPTION = 'Projects Locations Functions Commit Function Upgrade As Gen2

Official Cloud Functions endpoint: POST /v2/{+name}:commitFunctionUpgradeAsGen2
Commits a function upgrade from GCF Gen1 to GCF Gen2. This action deletes the Gen1 function, leaving the Gen2 function active and manageable by the GCFv2 API.';
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
    'description' => 'JSON request body matching the official Cloud Functions `CommitFunctionUpgradeAsGen2Request` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+name}:commitFunctionUpgradeAsGen2';
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
