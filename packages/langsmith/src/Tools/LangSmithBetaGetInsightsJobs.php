<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * [Beta] Get Insights Jobs.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/sessions/{session_id}/insights.
 */
class LangSmithBetaGetInsightsJobs extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_beta_get_insights_jobs';
    protected const DESCRIPTION = '[Beta] Get Insights Jobs

Official endpoint: GET /api/v1/sessions/{session_id}/insights
Get all clusters for a session.';
    protected const PARAMETERS = array (
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `session_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, offset, config_id, legacy.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
  'config_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `config_id`.',
  ),
  'legacy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `legacy`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/sessions/{session_id}/insights';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
  2 => 'config_id',
  3 => 'legacy',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
