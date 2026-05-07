<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Model Deployment Monitoring Jobs Get.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+name}.
 */
class GoogleVertexAiProjectsLocationsModelDeploymentMonitoringJobsGet extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_get';
    protected const DESCRIPTION = 'Projects Locations Model Deployment Monitoring Jobs Get

Official Vertex AI endpoint: GET /v1/{+name}
Gets a ModelDeploymentMonitoringJob.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+name}';
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
