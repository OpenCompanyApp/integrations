<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * [Beta] Get Insights Job Configs.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/sessions/{session_id}/insights/configs.
 */
class LangSmithBetaGetInsightsJobConfigs extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_beta_get_insights_job_configs';
    protected const DESCRIPTION = '[Beta] Get Insights Job Configs

Official endpoint: GET /api/v1/sessions/{session_id}/insights/configs
Get all insights job configs for a session.';
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
    'description' => 'Query string parameters. Known keys: include_prebuilts.',
  ),
  'include_prebuilts' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_prebuilts`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/sessions/{session_id}/insights/configs';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
);
    protected const QUERY_KEYS = array (
  0 => 'include_prebuilts',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
