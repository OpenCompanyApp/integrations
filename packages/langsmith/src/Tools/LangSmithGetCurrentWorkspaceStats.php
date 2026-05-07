<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Current Workspace Stats.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/stats.
 */
class LangSmithGetCurrentWorkspaceStats extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_current_workspace_stats';
    protected const DESCRIPTION = 'Get Current Workspace Stats

Official endpoint: GET /api/v1/workspaces/current/stats
Get Current Workspace Stats.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: tag_value_id.',
  ),
  'tag_value_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tag_value_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/stats';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'tag_value_id',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
