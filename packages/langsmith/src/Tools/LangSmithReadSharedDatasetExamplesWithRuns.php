<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Shared Dataset Examples With Runs.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/public/{share_token}/examples/runs.
 */
class LangSmithReadSharedDatasetExamplesWithRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_shared_dataset_examples_with_runs';
    protected const DESCRIPTION = 'Read Shared Dataset Examples With Runs

Official endpoint: POST /api/v1/public/{share_token}/examples/runs
Get examples with associated runs from sessions in a dataset that has been shared.';
    protected const PARAMETERS = array (
  'share_token' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `share_token`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/public/{share_token}/examples/runs';
    protected const PATH_PARAMS = array (
  0 => 'share_token',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
