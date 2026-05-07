<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Count Examples.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/examples/count.
 */
class LangSmithCountExamples extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_count_examples';
    protected const DESCRIPTION = 'Count Examples

Official endpoint: GET /api/v1/examples/count
Count all examples by query params';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: id, as_of, metadata, full_text_contains, splits, dataset, filter.',
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
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/examples/count';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'id',
  1 => 'as_of',
  2 => 'metadata',
  3 => 'full_text_contains',
  4 => 'splits',
  5 => 'dataset',
  6 => 'filter',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
