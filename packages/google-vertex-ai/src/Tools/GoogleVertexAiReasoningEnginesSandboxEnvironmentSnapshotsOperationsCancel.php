<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Reasoning Engines Sandbox Environment Snapshots Operations Cancel.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+name}:cancel.
 */
class GoogleVertexAiReasoningEnginesSandboxEnvironmentSnapshotsOperationsCancel extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_reasoning_engines_sandbox_environment_snapshots_operations_cancel';
    protected const DESCRIPTION = 'Reasoning Engines Sandbox Environment Snapshots Operations Cancel

Official Vertex AI endpoint: POST /v1/{+name}:cancel
Starts asynchronous cancellation on a long-running operation. The server makes a best effort to cancel the operation, but success is not guaranteed. If the server doesn\'t support this method, it returns `google.rpc.Code.UNIMPLEMENTED`. Clients can use Operations.GetOperation or other methods to check whether the cancellation succeeded or whether the operation completed despite cancellation. On successful cancellation, the operation is not deleted; instead, it becomes an operation with an Operation.error value with a google.rpc.Status.code of `1`, corresponding to `Code.CANCELLED`.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:cancel';
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
