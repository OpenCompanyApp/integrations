<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Worker Pools Patch.
 *
 * Maps to the official Cloud Run endpoint PATCH /v2/{+name}.
 */
class GoogleCloudRunProjectsLocationsWorkerPoolsPatch extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_worker_pools_patch';
    protected const DESCRIPTION = 'Projects Locations Worker Pools Patch

Official Cloud Run endpoint: PATCH /v2/{+name}
Updates a WorkerPool.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Cloud Run resource names such as `projects/example/locations/us-central1/services/api`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Run method. Known keys: allowMissing, validateOnly, updateMask, forceNewRevision.',
  ),
  'allowMissing' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `allowMissing`.',
  ),
  'validateOnly' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `validateOnly`.',
  ),
  'updateMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `updateMask`.',
  ),
  'forceNewRevision' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `forceNewRevision`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Run `GoogleCloudRunV2WorkerPool` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'allowMissing',
  1 => 'validateOnly',
  2 => 'updateMask',
  3 => 'forceNewRevision',
);
    protected const BODY_REQUIRED = true;
}
