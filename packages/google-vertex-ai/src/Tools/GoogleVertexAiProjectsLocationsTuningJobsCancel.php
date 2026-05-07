<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Tuning Jobs Cancel.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+name}:cancel.
 */
class GoogleVertexAiProjectsLocationsTuningJobsCancel extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_tuning_jobs_cancel';
    protected const DESCRIPTION = 'Projects Locations Tuning Jobs Cancel

Official Vertex AI endpoint: POST /v1/{+name}:cancel
Cancels a tuning job. Starts an asynchronous cancellation request. The server makes a best effort to cancel the job, but success is not guaranteed. Clients can use GenAiTuningService.GetTuningJob or other methods to check whether the cancellation succeeded or whether the job completed despite cancellation. On successful cancellation, the tuning job is not deleted. Instead, its state is set to `CANCELLED`, and `error` is set to a status with a `google.rpc.Status.code` of 1, corresponding to `Code.CANCELLED`.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1CancelTuningJobRequest` schema.',
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
    protected const BODY_REQUIRED = true;
}
