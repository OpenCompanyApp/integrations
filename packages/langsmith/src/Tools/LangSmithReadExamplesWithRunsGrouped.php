<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Examples With Runs Grouped.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets/{dataset_id}/group/runs.
 */
class LangSmithReadExamplesWithRunsGrouped extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_examples_with_runs_grouped';
    protected const DESCRIPTION = 'Read Examples With Runs Grouped

Official endpoint: POST /api/v1/datasets/{dataset_id}/group/runs
Fetch examples for a dataset, and fetch the runs for each example if they are associated with the given session_ids.';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/datasets/{dataset_id}/group/runs';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
