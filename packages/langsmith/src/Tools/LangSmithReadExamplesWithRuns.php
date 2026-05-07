<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Examples With Runs.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets/{dataset_id}/runs.
 */
class LangSmithReadExamplesWithRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_examples_with_runs';
    protected const DESCRIPTION = 'Read Examples With Runs

Official endpoint: POST /api/v1/datasets/{dataset_id}/runs
Fetch examples for a dataset, and fetch the runs for each example if they are associated with the given session_ids.';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: format.',
  ),
  'format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `format`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/datasets/{dataset_id}/runs';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
  0 => 'format',
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
