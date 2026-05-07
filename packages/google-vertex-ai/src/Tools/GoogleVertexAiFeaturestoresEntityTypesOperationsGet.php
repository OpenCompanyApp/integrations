<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Featurestores Entity Types Operations Get.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+name}.
 */
class GoogleVertexAiFeaturestoresEntityTypesOperationsGet extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_featurestores_entity_types_operations_get';
    protected const DESCRIPTION = 'Featurestores Entity Types Operations Get

Official Vertex AI endpoint: GET /v1/{+name}
Gets the latest state of a long-running operation. Clients can use this method to poll the operation result at intervals as recommended by the API service.';
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
