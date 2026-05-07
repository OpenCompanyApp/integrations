<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Model Deployment Monitoring Jobs List.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+parent}/modelDeploymentMonitoringJobs.
 */
class GoogleVertexAiProjectsLocationsModelDeploymentMonitoringJobsList extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_model_deployment_monitoring_jobs_list';
    protected const DESCRIPTION = 'Projects Locations Model Deployment Monitoring Jobs List

Official Vertex AI endpoint: GET /v1/{+parent}/modelDeploymentMonitoringJobs
Lists ModelDeploymentMonitoringJobs in a Location.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: pageToken, filter, readMask, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'readMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `readMask`.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+parent}/modelDeploymentMonitoringJobs';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'filter',
  2 => 'readMask',
  3 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
