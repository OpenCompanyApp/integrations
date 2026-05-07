<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Datasets List.
 *
 * Maps to the official Vertex AI endpoint GET /v1/datasets.
 */
class GoogleVertexAiDatasetsList extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_datasets_list';
    protected const DESCRIPTION = 'Datasets List

Official Vertex AI endpoint: GET /v1/datasets
Lists Datasets in a Location.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: pageToken, orderBy, filter, readMask, pageSize, parent.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderBy`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'readMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `readMask`.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'parent' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `parent`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/datasets';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'orderBy',
  2 => 'filter',
  3 => 'readMask',
  4 => 'pageSize',
  5 => 'parent',
);
    protected const BODY_REQUIRED = false;
}
