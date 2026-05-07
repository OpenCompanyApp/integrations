<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List sandbox claims.
 *
 * Maps to the official LangSmith endpoint GET /v2/sandboxes/boxes.
 */
class LangSmithGetV2SandboxesBoxes extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v2_sandboxes_boxes';
    protected const DESCRIPTION = 'List sandbox claims

Official endpoint: GET /v2/sandboxes/boxes
List sandbox claims for the authenticated tenant, with optional filtering, sorting, and pagination.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, offset, name_contains, status, sort_by, sort_direction.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
  'name_contains' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `name_contains`.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `status`.',
  ),
  'sort_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by`.',
  ),
  'sort_direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_direction`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/sandboxes/boxes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
  2 => 'name_contains',
  3 => 'status',
  4 => 'sort_by',
  5 => 'sort_direction',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
