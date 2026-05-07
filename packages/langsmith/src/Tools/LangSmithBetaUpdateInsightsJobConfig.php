<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * [Beta] Update Insights Job Config.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/sessions/{session_id}/insights/configs/{config_id}.
 */
class LangSmithBetaUpdateInsightsJobConfig extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_beta_update_insights_job_config';
    protected const DESCRIPTION = '[Beta] Update Insights Job Config

Official endpoint: PATCH /api/v1/sessions/{session_id}/insights/configs/{config_id}
Update an insights job config.';
    protected const PARAMETERS = array (
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `session_id`.',
  ),
  'config_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `config_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/sessions/{session_id}/insights/configs/{config_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
  1 => 'config_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
