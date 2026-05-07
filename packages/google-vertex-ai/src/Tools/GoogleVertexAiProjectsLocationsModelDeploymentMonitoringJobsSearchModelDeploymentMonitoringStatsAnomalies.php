<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Model Deployment Monitoring Jobs Search Model Deployment Monitoring Stats Anomalies.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+modelDeploymentMonitoringJob}:searchModelDeploymentMonitoringStatsAnomalies.
 */
class GoogleVertexAiProjectsLocationsModelDeploymentMonitoringJobsSearchModelDeploymentMonitoringStatsAnomalies extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_search_model_deployment_monitoring_stats_anomalies';
    protected const DESCRIPTION = 'Projects Locations Model Deployment Monitoring Jobs Search Model Deployment Monitoring Stats Anomalies

Official Vertex AI endpoint: POST /v1/{+modelDeploymentMonitoringJob}:searchModelDeploymentMonitoringStatsAnomalies
Searches Model Monitoring Statistics generated within a given time window.';
    protected const PARAMETERS = array (
  'modelDeploymentMonitoringJob' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `modelDeploymentMonitoringJob`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1SearchModelDeploymentMonitoringStatsAnomaliesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+modelDeploymentMonitoringJob}:searchModelDeploymentMonitoringStatsAnomalies';
    protected const PATH_PARAMS = array (
  0 => 'modelDeploymentMonitoringJob',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'modelDeploymentMonitoringJob',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
