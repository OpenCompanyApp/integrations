<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Datasets Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/datasets.
 */
class GoogleVertexAiDatasetsCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_datasets_create';
    protected const DESCRIPTION = 'Datasets Create

Official Vertex AI endpoint: POST /v1/datasets
Creates a Dataset.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: parent.',
  ),
  'parent' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `parent`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1Dataset` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/datasets';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'parent',
);
    protected const BODY_REQUIRED = true;
}
