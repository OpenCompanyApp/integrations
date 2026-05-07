<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Builds Submit.
 *
 * Maps to the official Cloud Run endpoint POST /v2/{+parent}/builds:submit.
 */
class GoogleCloudRunProjectsLocationsBuildsSubmit extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_builds_submit';
    protected const DESCRIPTION = 'Projects Locations Builds Submit

Official Cloud Run endpoint: POST /v2/{+parent}/builds:submit
Submits a build in a given project.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Cloud Run resource names such as `projects/example/locations/us-central1/services/api`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Run `GoogleCloudRunV2SubmitBuildRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+parent}/builds:submit';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
