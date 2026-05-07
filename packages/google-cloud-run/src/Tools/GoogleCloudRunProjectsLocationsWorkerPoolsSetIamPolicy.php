<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Worker Pools Set Iam Policy.
 *
 * Maps to the official Cloud Run endpoint POST /v2/{+resource}:setIamPolicy.
 */
class GoogleCloudRunProjectsLocationsWorkerPoolsSetIamPolicy extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_worker_pools_set_iam_policy';
    protected const DESCRIPTION = 'Projects Locations Worker Pools Set Iam Policy

Official Cloud Run endpoint: POST /v2/{+resource}:setIamPolicy
Sets the IAM Access control policy for the specified WorkerPool. Overwrites any existing policy.';
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
    'description' => 'JSON request body matching the official Cloud Run `GoogleIamV1SetIamPolicyRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+resource}:setIamPolicy';
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
