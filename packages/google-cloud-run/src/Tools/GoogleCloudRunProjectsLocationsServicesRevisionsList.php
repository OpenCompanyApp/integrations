<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Services Revisions List.
 *
 * Maps to the official Cloud Run endpoint GET /v2/{+parent}/revisions.
 */
class GoogleCloudRunProjectsLocationsServicesRevisionsList extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_services_revisions_list';
    protected const DESCRIPTION = 'Projects Locations Services Revisions List

Official Cloud Run endpoint: GET /v2/{+parent}/revisions
Lists Revisions from a given Service, or from a given location. Results are sorted by creation time, descending.';
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
    'description' => 'Query string parameters accepted by the official Cloud Run method. Known keys: showDeleted, pageSize, pageToken.',
  ),
  'showDeleted' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `showDeleted`.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{+parent}/revisions';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'showDeleted',
  1 => 'pageSize',
  2 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
