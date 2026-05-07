<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Instances List.
 *
 * Maps to the official Cloud Run endpoint GET /v2/{+parent}/instances.
 */
class GoogleCloudRunProjectsLocationsInstancesList extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_instances_list';
    protected const DESCRIPTION = 'Projects Locations Instances List

Official Cloud Run endpoint: GET /v2/{+parent}/instances
Lists Instances. Results are sorted by creation time, descending.';
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
    'description' => 'Query string parameters accepted by the official Cloud Run method. Known keys: showDeleted, pageToken, pageSize.',
  ),
  'showDeleted' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `showDeleted`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{+parent}/instances';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'showDeleted',
  1 => 'pageToken',
  2 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
