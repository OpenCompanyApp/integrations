<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Models Update Explanation Dataset.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+model}:updateExplanationDataset.
 */
class GoogleVertexAiProjectsLocationsModelsUpdateExplanationDataset extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_models_update_explanation_dataset';
    protected const DESCRIPTION = 'Projects Locations Models Update Explanation Dataset

Official Vertex AI endpoint: POST /v1/{+model}:updateExplanationDataset
Incrementally update the dataset used for an examples model.';
    protected const PARAMETERS = array (
  'model' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `model`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1UpdateExplanationDatasetRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+model}:updateExplanationDataset';
    protected const PATH_PARAMS = array (
  0 => 'model',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'model',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
