<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Example.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/examples.
 */
class LangSmithCreateExample extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_example';
    protected const DESCRIPTION = 'Create Example

Official endpoint: POST /api/v1/examples
Create a new example.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/examples';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
