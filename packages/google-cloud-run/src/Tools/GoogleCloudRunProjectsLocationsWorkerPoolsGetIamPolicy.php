<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Worker Pools Get Iam Policy.
 *
 * Maps to the official Cloud Run endpoint GET /v2/{+resource}:getIamPolicy.
 */
class GoogleCloudRunProjectsLocationsWorkerPoolsGetIamPolicy extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_worker_pools_get_iam_policy';
    protected const DESCRIPTION = 'Projects Locations Worker Pools Get Iam Policy

Official Cloud Run endpoint: GET /v2/{+resource}:getIamPolicy
Gets the IAM Access Control policy currently in effect for the given Cloud Run WorkerPool. This result does not include any inherited policies.';
    protected const PARAMETERS = array (
  'resource' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource`. Use full Cloud Run resource names such as `projects/example/locations/us-central1/services/api`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Run method. Known keys: options.requestedPolicyVersion.',
  ),
  'options.requestedPolicyVersion' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `options.requestedPolicyVersion`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{+resource}:getIamPolicy';
    protected const PATH_PARAMS = array (
  0 => 'resource',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resource',
);
    protected const QUERY_KEYS = array (
  0 => 'options.requestedPolicyVersion',
);
    protected const BODY_REQUIRED = false;
}
