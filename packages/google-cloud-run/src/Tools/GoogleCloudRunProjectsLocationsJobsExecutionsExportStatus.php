<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Jobs Executions Export Status.
 *
 * Maps to the official Cloud Run endpoint GET /v2/{+name}/{+operationId}:exportStatus.
 */
class GoogleCloudRunProjectsLocationsJobsExecutionsExportStatus extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_jobs_executions_export_status';
    protected const DESCRIPTION = 'Projects Locations Jobs Executions Export Status

Official Cloud Run endpoint: GET /v2/{+name}/{+operationId}:exportStatus
Read the status of an image export operation.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Cloud Run resource names such as `projects/example/locations/us-central1/services/api`.',
  ),
  'operationId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `operationId`. Use full Cloud Run resource names such as `projects/example/locations/us-central1/services/api`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{+name}/{+operationId}:exportStatus';
    protected const PATH_PARAMS = array (
  0 => 'name',
  1 => 'operationId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
  1 => 'operationId',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
