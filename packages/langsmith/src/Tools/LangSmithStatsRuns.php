<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Stats Runs.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/runs/stats.
 */
class LangSmithStatsRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_stats_runs';
    protected const DESCRIPTION = 'Stats Runs

Official endpoint: POST /api/v1/runs/stats
Get all runs by query in body payload.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/runs/stats';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
