<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Operations Delete.
 *
 * Maps to the official Cloud Run endpoint DELETE /v2/{+name}.
 */
class GoogleCloudRunProjectsLocationsOperationsDelete extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_operations_delete';
    protected const DESCRIPTION = 'Projects Locations Operations Delete

Official Cloud Run endpoint: DELETE /v2/{+name}
Deletes a long-running operation. This method indicates that the client is no longer interested in the operation result. It does not cancel the operation. If the server doesn\'t support this method, it returns `google.rpc.Code.UNIMPLEMENTED`.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Cloud Run resource names such as `projects/example/locations/us-central1/services/api`.',
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
);
    protected const BODY_REQUIRED = false;
}
