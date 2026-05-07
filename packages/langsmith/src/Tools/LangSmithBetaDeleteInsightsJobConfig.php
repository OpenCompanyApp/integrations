<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * [Beta] Delete Insights Job Config.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/sessions/{session_id}/insights/configs/{config_id}.
 */
class LangSmithBetaDeleteInsightsJobConfig extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_beta_delete_insights_job_config';
    protected const DESCRIPTION = '[Beta] Delete Insights Job Config

Official endpoint: DELETE /api/v1/sessions/{session_id}/insights/configs/{config_id}
Delete an insights job config.';
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
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/sessions/{session_id}/insights/configs/{config_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
  1 => 'config_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
