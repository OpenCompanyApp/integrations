<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Examples.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/examples/bulk.
 */
class LangSmithCreateExamples extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_examples';
    protected const DESCRIPTION = 'Create Examples

Official endpoint: POST /api/v1/examples/bulk
Create bulk examples.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/examples/bulk';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
