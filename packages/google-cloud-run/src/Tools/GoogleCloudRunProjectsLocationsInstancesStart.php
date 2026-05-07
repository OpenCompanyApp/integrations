<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Instances Start.
 *
 * Maps to the official Cloud Run endpoint POST /v2/{+name}:start.
 */
class GoogleCloudRunProjectsLocationsInstancesStart extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_instances_start';
    protected const DESCRIPTION = 'Projects Locations Instances Start

Official Cloud Run endpoint: POST /v2/{+name}:start
Starts an Instance.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Cloud Run resource names such as `projects/example/locations/us-central1/services/api`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Run `GoogleCloudRunV2StartInstanceRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+name}:start';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
