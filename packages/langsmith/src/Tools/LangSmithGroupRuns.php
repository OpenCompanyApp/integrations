<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Group Runs.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/runs/group.
 */
class LangSmithGroupRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_group_runs';
    protected const DESCRIPTION = 'Group Runs

Official endpoint: POST /api/v1/runs/group
Get runs grouped by an expression';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/runs/group';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
