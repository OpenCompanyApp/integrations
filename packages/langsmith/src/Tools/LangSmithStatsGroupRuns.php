<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Stats Group Runs.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/runs/group/stats.
 */
class LangSmithStatsGroupRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_stats_group_runs';
    protected const DESCRIPTION = 'Stats Group Runs

Official endpoint: POST /api/v1/runs/group/stats
Get stats for the grouped runs.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/runs/group/stats';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
