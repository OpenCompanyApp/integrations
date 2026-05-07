<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Example.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/examples/{example_id}.
 */
class LangSmithDeleteExample extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_example';
    protected const DESCRIPTION = 'Delete Example

Official endpoint: DELETE /api/v1/examples/{example_id}
Soft delete an example. Only deletes the example in the \'latest\' version of the dataset.';
    protected const PARAMETERS = array (
  'example_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `example_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/examples/{example_id}';
    protected const PATH_PARAMS = array (
  0 => 'example_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
