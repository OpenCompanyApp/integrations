<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Generate Instance Rubrics.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+location}:generateInstanceRubrics.
 */
class GoogleVertexAiProjectsLocationsGenerateInstanceRubrics extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_generate_instance_rubrics';
    protected const DESCRIPTION = 'Projects Locations Generate Instance Rubrics

Official Vertex AI endpoint: POST /v1/{+location}:generateInstanceRubrics
Generates rubrics for a given prompt. A rubric represents a single testable criterion for evaluation. One input prompt could have multiple rubrics This RPC allows users to get suggested rubrics based on provided prompt, which can then be reviewed and used for subsequent evaluations.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1GenerateInstanceRubricsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+location}:generateInstanceRubrics';
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
