<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Example.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/examples/{example_id}.
 */
class LangSmithUpdateExample extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_example';
    protected const DESCRIPTION = 'Update Example

Official endpoint: PATCH /api/v1/examples/{example_id}
Update a specific example.';
    protected const PARAMETERS = array (
  'example_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `example_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/examples/{example_id}';
    protected const PATH_PARAMS = array (
  0 => 'example_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
