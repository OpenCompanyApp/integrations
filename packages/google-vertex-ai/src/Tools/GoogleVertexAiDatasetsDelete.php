<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Datasets Delete.
 *
 * Maps to the official Vertex AI endpoint DELETE /v1/{+name}.
 */
class GoogleVertexAiDatasetsDelete extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_datasets_delete';
    protected const DESCRIPTION = 'Datasets Delete

Official Vertex AI endpoint: DELETE /v1/{+name}
Deletes a Dataset.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
);
    protected const METHOD = 'DELETE';
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
