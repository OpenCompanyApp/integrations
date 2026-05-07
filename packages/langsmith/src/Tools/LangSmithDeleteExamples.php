<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Examples.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/examples.
 */
class LangSmithDeleteExamples extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_examples';
    protected const DESCRIPTION = 'Delete Examples

Official endpoint: DELETE /api/v1/examples
Soft delete examples. Only deletes the examples in the \'latest\' version of the dataset.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: example_ids.',
  ),
  'example_ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `example_ids`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/examples';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'example_ids',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
