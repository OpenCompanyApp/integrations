<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Examples.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/examples.
 */
class LangSmithReadExamples extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_examples';
    protected const DESCRIPTION = 'Read Examples

Official endpoint: GET /api/v1/examples
Get all examples by query params';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: id, as_of, metadata, full_text_contains, splits, dataset, offset, limit, order, random_seed, select, descending, filter.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `id`.',
  ),
  'as_of' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `as_of`.',
  ),
  'metadata' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `metadata`.',
  ),
  'full_text_contains' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `full_text_contains`.',
  ),
  'splits' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `splits`.',
  ),
  'dataset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `dataset`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `order`.',
  ),
  'random_seed' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `random_seed`.',
  ),
  'select' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `select`.',
  ),
  'descending' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `descending`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/examples';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'id',
  1 => 'as_of',
  2 => 'metadata',
  3 => 'full_text_contains',
  4 => 'splits',
  5 => 'dataset',
  6 => 'offset',
  7 => 'limit',
  8 => 'order',
  9 => 'random_seed',
  10 => 'select',
  11 => 'descending',
  12 => 'filter',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
