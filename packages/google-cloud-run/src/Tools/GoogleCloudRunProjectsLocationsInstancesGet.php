<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Instances Get.
 *
 * Maps to the official Cloud Run endpoint GET /v2/{+name}.
 */
class GoogleCloudRunProjectsLocationsInstancesGet extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_instances_get';
    protected const DESCRIPTION = 'Projects Locations Instances Get

Official Cloud Run endpoint: GET /v2/{+name}
Gets a Instance';
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
