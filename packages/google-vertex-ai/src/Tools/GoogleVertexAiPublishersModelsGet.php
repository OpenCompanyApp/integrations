<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Publishers Models Get.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+name}.
 */
class GoogleVertexAiPublishersModelsGet extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_publishers_models_get';
    protected const DESCRIPTION = 'Publishers Models Get

Official Vertex AI endpoint: GET /v1/{+name}
Gets a Model Garden publisher model.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: huggingFaceToken, isHuggingFaceModel, languageCode, view.',
  ),
  'huggingFaceToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `huggingFaceToken`.',
  ),
  'isHuggingFaceModel' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `isHuggingFaceModel`.',
  ),
  'languageCode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `languageCode`.',
  ),
  'view' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `view`.',
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
  0 => 'huggingFaceToken',
  1 => 'isHuggingFaceModel',
  2 => 'languageCode',
  3 => 'view',
);
    protected const BODY_REQUIRED = false;
}
