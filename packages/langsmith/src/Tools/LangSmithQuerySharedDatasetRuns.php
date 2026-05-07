<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Query Shared Dataset Runs.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/public/{share_token}/datasets/runs/query.
 */
class LangSmithQuerySharedDatasetRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_query_shared_dataset_runs';
    protected const DESCRIPTION = 'Query Shared Dataset Runs

Official endpoint: POST /api/v1/public/{share_token}/datasets/runs/query
Get runs in projects run over a dataset that has been shared.';
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
    protected const PATH = '/api/v1/public/{share_token}/datasets/runs/query';
    protected const PATH_PARAMS = array (
  0 => 'share_token',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
