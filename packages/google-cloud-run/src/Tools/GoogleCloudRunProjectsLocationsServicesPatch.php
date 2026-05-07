<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Services Patch.
 *
 * Maps to the official Cloud Run endpoint PATCH /v2/{+name}.
 */
class GoogleCloudRunProjectsLocationsServicesPatch extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_services_patch';
    protected const DESCRIPTION = 'Projects Locations Services Patch

Official Cloud Run endpoint: PATCH /v2/{+name}
Updates a Service.';
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
    'description' => 'Query string parameters accepted by the official Cloud Run method. Known keys: updateMask, forceNewRevision, allowMissing, validateOnly.',
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Run `GoogleCloudRunV2Service` schema.',
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
  0 => 'updateMask',
  1 => 'forceNewRevision',
  2 => 'allowMissing',
  3 => 'validateOnly',
);
    protected const BODY_REQUIRED = true;
}
