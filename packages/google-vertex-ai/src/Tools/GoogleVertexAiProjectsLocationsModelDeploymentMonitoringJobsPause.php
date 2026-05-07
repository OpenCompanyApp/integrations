<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Model Deployment Monitoring Jobs Pause.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+name}:pause.
 */
class GoogleVertexAiProjectsLocationsModelDeploymentMonitoringJobsPause extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_pause';
    protected const DESCRIPTION = 'Projects Locations Model Deployment Monitoring Jobs Pause

Official Vertex AI endpoint: POST /v1/{+name}:pause
Pauses a ModelDeploymentMonitoringJob. If the job is running, the server makes a best effort to cancel the job. Will mark ModelDeploymentMonitoringJob.state to \'PAUSED\'.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1PauseModelDeploymentMonitoringJobRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:pause';
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
