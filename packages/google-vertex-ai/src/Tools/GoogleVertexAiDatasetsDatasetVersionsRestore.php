<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Datasets Dataset Versions Restore.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+name}:restore.
 */
class GoogleVertexAiDatasetsDatasetVersionsRestore extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_datasets_dataset_versions_restore';
    protected const DESCRIPTION = 'Datasets Dataset Versions Restore

Official Vertex AI endpoint: GET /v1/{+name}:restore
Restores a dataset version.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+name}:restore';
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
