<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Datasets Dataset Versions Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/datasetVersions.
 */
class GoogleVertexAiDatasetsDatasetVersionsCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_datasets_dataset_versions_create';
    protected const DESCRIPTION = 'Datasets Dataset Versions Create

Official Vertex AI endpoint: POST /v1/{+parent}/datasetVersions
Create a version from a Dataset.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1DatasetVersion` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/datasetVersions';
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
