<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Evaluate Instances.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+location}:evaluateInstances.
 */
class GoogleVertexAiProjectsLocationsEvaluateInstances extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_evaluate_instances';
    protected const DESCRIPTION = 'Projects Locations Evaluate Instances

Official Vertex AI endpoint: POST /v1/{+location}:evaluateInstances
Evaluates instances based on a given metric.';
    protected const PARAMETERS = array (
  'location' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `location`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1EvaluateInstancesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+location}:evaluateInstances';
    protected const PATH_PARAMS = array (
  0 => 'location',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'location',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
