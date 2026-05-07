<?php

namespace OpenCompany\Integrations\GoogleCloudRun\Tools;

/**
 * Projects Locations Operations Wait.
 *
 * Maps to the official Cloud Run endpoint POST /v2/{+name}:wait.
 */
class GoogleCloudRunProjectsLocationsOperationsWait extends AbstractGoogleCloudRunTool
{
    protected const NAME = 'google_cloud_run_projects_locations_operations_wait';
    protected const DESCRIPTION = 'Projects Locations Operations Wait

Official Cloud Run endpoint: POST /v2/{+name}:wait
Waits until the specified long-running operation is done or reaches at most a specified timeout, returning the latest state. If the operation is already done, the latest state is immediately returned. If the timeout specified is greater than the default HTTP/RPC timeout, the HTTP/RPC timeout is used. If the server does not support this method, it returns `google.rpc.Code.UNIMPLEMENTED`. Note that this method is on a best-effort basis. It may return the latest state before the specified timeout (including immediately), meaning even an immediate response is no guarantee that the operation is done.';
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
    'description' => 'JSON request body matching the official Cloud Run `GoogleLongrunningWaitOperationRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+name}:wait';
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
