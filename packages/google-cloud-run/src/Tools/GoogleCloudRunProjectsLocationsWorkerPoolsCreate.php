<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Worker Pools Create.
 *
 * Maps to the official Cloud Run endpoint POST /v2/{+parent}/workerPools.
 */
class GoogleCloudRunProjectsLocationsWorkerPoolsCreate extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_worker_pools_create';
    protected const DESCRIPTION = 'Projects Locations Worker Pools Create

Official Cloud Run endpoint: POST /v2/{+parent}/workerPools
Creates a new WorkerPool in a given project and location.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Cloud Run resource names such as `projects/example/locations/us-central1/services/api`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Run method. Known keys: workerPoolId, validateOnly.',
  ),
  'workerPoolId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `workerPoolId`.',
  ),
  'validateOnly' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `validateOnly`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Run `GoogleCloudRunV2WorkerPool` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+parent}/workerPools';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'workerPoolId',
  1 => 'validateOnly',
);
    protected const BODY_REQUIRED = true;
}
