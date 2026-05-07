<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Operations List.
 *
 * Maps to the official Vertex AI endpoint GET /v1/operations.
 */
class GoogleVertexAiOperationsList extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_operations_list';
    protected const DESCRIPTION = 'Operations List

Official Vertex AI endpoint: GET /v1/operations
Lists operations that match the specified filter in the request. If the server doesn\'t support this method, it returns `UNIMPLEMENTED`.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: filter, name, pageToken, pageSize, returnPartialSuccess.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `name`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'returnPartialSuccess' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `returnPartialSuccess`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/operations';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'filter',
  1 => 'name',
  2 => 'pageToken',
  3 => 'pageSize',
  4 => 'returnPartialSuccess',
);
    protected const BODY_REQUIRED = false;
}
