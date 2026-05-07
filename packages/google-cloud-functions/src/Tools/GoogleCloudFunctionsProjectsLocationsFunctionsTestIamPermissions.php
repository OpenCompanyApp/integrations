<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Functions Test Iam Permissions.
 *
 * Maps to the official Cloud Functions endpoint POST /v2/{+resource}:testIamPermissions.
 */
class GoogleCloudFunctionsProjectsLocationsFunctionsTestIamPermissions extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_functions_test_iam_permissions';
    protected const DESCRIPTION = 'Projects Locations Functions Test Iam Permissions

Official Cloud Functions endpoint: POST /v2/{+resource}:testIamPermissions
Returns permissions that a caller has on the specified resource. If the resource does not exist, this will return an empty set of permissions, not a `NOT_FOUND` error. Note: This operation is designed to be used for building permission-aware UIs and command-line tools, not for authorization checking. This operation may "fail open" without warning.';
    protected const PARAMETERS = array (
  'resource' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource`. Use full Cloud Functions resource names such as `projects/example/locations/us-central1/functions/api`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Functions `TestIamPermissionsRequest` schema.',
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
