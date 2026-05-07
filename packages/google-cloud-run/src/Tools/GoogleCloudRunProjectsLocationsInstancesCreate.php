<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Instances Create.
 *
 * Maps to the official Cloud Run endpoint POST /v2/{+parent}/instances.
 */
class GoogleCloudRunProjectsLocationsInstancesCreate extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_instances_create';
    protected const DESCRIPTION = 'Projects Locations Instances Create

Official Cloud Run endpoint: POST /v2/{+parent}/instances
Creates an Instance.';
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
    'description' => 'Query string parameters accepted by the official Cloud Run method. Known keys: validateOnly, instanceId.',
  ),
  'validateOnly' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `validateOnly`.',
  ),
  'instanceId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `instanceId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Run `GoogleCloudRunV2Instance` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+parent}/instances';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'validateOnly',
  1 => 'instanceId',
);
    protected const BODY_REQUIRED = true;
}
