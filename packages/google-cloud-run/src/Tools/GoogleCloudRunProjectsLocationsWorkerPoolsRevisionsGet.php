<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Worker Pools Revisions Get.
 *
 * Maps to the official Cloud Run endpoint GET /v2/{+name}.
 */
class GoogleCloudRunProjectsLocationsWorkerPoolsRevisionsGet extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_worker_pools_revisions_get';
    protected const DESCRIPTION = 'Projects Locations Worker Pools Revisions Get

Official Cloud Run endpoint: GET /v2/{+name}
Gets information about a Revision.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Cloud Run resource names such as `projects/example/locations/us-central1/services/api`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
