<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Jobs Patch.
 *
 * Maps to the official Cloud Run endpoint PATCH /v2/{+name}.
 */
class GoogleCloudRunProjectsLocationsJobsPatch extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_jobs_patch';
    protected const DESCRIPTION = 'Projects Locations Jobs Patch

Official Cloud Run endpoint: PATCH /v2/{+name}
Updates a Job.';
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
    'description' => 'Query string parameters accepted by the official Cloud Run method. Known keys: validateOnly, allowMissing.',
  ),
  'validateOnly' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `validateOnly`.',
  ),
  'allowMissing' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `allowMissing`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Run `GoogleCloudRunV2Job` schema.',
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
  0 => 'validateOnly',
  1 => 'allowMissing',
);
    protected const BODY_REQUIRED = true;
}
