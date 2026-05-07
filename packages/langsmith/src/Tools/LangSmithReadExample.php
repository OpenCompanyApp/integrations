<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Example.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/examples/{example_id}.
 */
class LangSmithReadExample extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_example';
    protected const DESCRIPTION = 'Read Example

Official endpoint: GET /api/v1/examples/{example_id}
Get a specific example.';
    protected const PARAMETERS = array (
  'example_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `example_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: as_of, dataset.',
  ),
  'as_of' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `as_of`.',
  ),
  'dataset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `dataset`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/examples/{example_id}';
    protected const PATH_PARAMS = array (
  0 => 'example_id',
);
    protected const QUERY_KEYS = array (
  0 => 'as_of',
  1 => 'dataset',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
