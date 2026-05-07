<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Services Revisions Delete.
 *
 * Maps to the official Cloud Run endpoint DELETE /v2/{+name}.
 */
class GoogleCloudRunProjectsLocationsServicesRevisionsDelete extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_services_revisions_delete';
    protected const DESCRIPTION = 'Projects Locations Services Revisions Delete

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
    'description' => 'Query string parameters accepted by the official Cloud Run method. Known keys: etag, validateOnly.',
  ),
  'etag' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `etag`.',
  ),
  'validateOnly' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `validateOnly`.',
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
  0 => 'etag',
  1 => 'validateOnly',
);
    protected const BODY_REQUIRED = false;
}
