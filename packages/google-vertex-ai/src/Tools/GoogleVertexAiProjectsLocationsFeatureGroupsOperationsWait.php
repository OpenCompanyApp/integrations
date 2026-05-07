<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Feature Groups Operations Wait.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+name}:wait.
 */
class GoogleVertexAiProjectsLocationsFeatureGroupsOperationsWait extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_feature_groups_operations_wait';
    protected const DESCRIPTION = 'Projects Locations Feature Groups Operations Wait

Official Vertex AI endpoint: POST /v1/{+name}:wait
Waits until the specified long-running operation is done or reaches at most a specified timeout, returning the latest state. If the operation is already done, the latest state is immediately returned. If the timeout specified is greater than the default HTTP/RPC timeout, the HTTP/RPC timeout is used. If the server does not support this method, it returns `google.rpc.Code.UNIMPLEMENTED`. Note that this method is on a best-effort basis. It may return the latest state before the specified timeout (including immediately), meaning even an immediate response is no guarantee that the operation is done.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: timeout.',
  ),
  'timeout' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `timeout`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:wait';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'timeout',
);
    protected const BODY_REQUIRED = false;
}
