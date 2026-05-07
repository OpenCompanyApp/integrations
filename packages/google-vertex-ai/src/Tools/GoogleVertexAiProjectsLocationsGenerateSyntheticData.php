<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Generate Synthetic Data.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+location}:generateSyntheticData.
 */
class GoogleVertexAiProjectsLocationsGenerateSyntheticData extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_generate_synthetic_data';
    protected const DESCRIPTION = 'Projects Locations Generate Synthetic Data

Official Vertex AI endpoint: POST /v1/{+location}:generateSyntheticData
Generates synthetic (artificial) data based on a description';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1GenerateSyntheticDataRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+location}:generateSyntheticData';
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
