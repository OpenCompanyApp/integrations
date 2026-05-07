<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Model Deployment Monitoring Jobs Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/modelDeploymentMonitoringJobs.
 */
class GoogleVertexAiProjectsLocationsModelDeploymentMonitoringJobsCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_create';
    protected const DESCRIPTION = 'Projects Locations Model Deployment Monitoring Jobs Create

Official Vertex AI endpoint: POST /v1/{+parent}/modelDeploymentMonitoringJobs
Creates a ModelDeploymentMonitoringJob. It will run periodically on a configured interval.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1ModelDeploymentMonitoringJob` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/modelDeploymentMonitoringJobs';
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
