<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Datasets Data Items Annotations Operations List.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+name}/operations.
 */
class GoogleVertexAiDatasetsDataItemsAnnotationsOperationsList extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_datasets_data_items_annotations_operations_list';
    protected const DESCRIPTION = 'Datasets Data Items Annotations Operations List

Official Vertex AI endpoint: GET /v1/{+name}/operations
Lists operations that match the specified filter in the request. If the server doesn\'t support this method, it returns `UNIMPLEMENTED`.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: returnPartialSuccess, pageSize, pageToken, filter.',
  ),
  'returnPartialSuccess' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `returnPartialSuccess`.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+name}/operations';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'returnPartialSuccess',
  1 => 'pageSize',
  2 => 'pageToken',
  3 => 'filter',
);
    protected const BODY_REQUIRED = false;
}
