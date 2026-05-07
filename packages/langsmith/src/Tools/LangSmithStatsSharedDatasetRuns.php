<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Stats Shared Dataset Runs.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/public/{share_token}/datasets/runs/stats.
 */
class LangSmithStatsSharedDatasetRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_stats_shared_dataset_runs';
    protected const DESCRIPTION = 'Stats Shared Dataset Runs

Official endpoint: POST /api/v1/public/{share_token}/datasets/runs/stats
Get run stats in projects run over a dataset that has been shared.';
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
    protected const PATH = '/api/v1/public/{share_token}/datasets/runs/stats';
    protected const PATH_PARAMS = array (
  0 => 'share_token',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
