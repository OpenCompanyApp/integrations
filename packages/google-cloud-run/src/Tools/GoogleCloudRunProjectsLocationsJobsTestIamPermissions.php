<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Jobs Test Iam Permissions.
 *
 * Maps to the official Cloud Run endpoint POST /v2/{+resource}:testIamPermissions.
 */
class GoogleCloudRunProjectsLocationsJobsTestIamPermissions extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_jobs_test_iam_permissions';
    protected const DESCRIPTION = 'Projects Locations Jobs Test Iam Permissions

Official Cloud Run endpoint: POST /v2/{+resource}:testIamPermissions
Returns permissions that a caller has on the specified Project. There are no permissions required for making this API call.';
    protected const PARAMETERS = array (
  'resource' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource`. Use full Cloud Run resource names such as `projects/example/locations/us-central1/services/api`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Run `GoogleIamV1TestIamPermissionsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+resource}:testIamPermissions';
    protected const PATH_PARAMS = array (
  0 => 'resource',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resource',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
