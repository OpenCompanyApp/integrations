<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Worker Pools Revisions Delete.
 *
 * Maps to the official Cloud Run endpoint DELETE /v2/{+name}.
 */
class GoogleCloudRunProjectsLocationsWorkerPoolsRevisionsDelete extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_worker_pools_revisions_delete';
    protected const DESCRIPTION = 'Projects Locations Worker Pools Revisions Delete

Official Cloud Run endpoint: DELETE /v2/{+name}
Deletes a Revision.';
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
    'description' => 'Query string parameters accepted by the official Cloud Run method. Known keys: validateOnly, etag.',
  ),
  'validateOnly' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `validateOnly`.',
  ),
  'etag' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `etag`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'validateOnly',
  1 => 'etag',
);
    protected const BODY_REQUIRED = false;
}
