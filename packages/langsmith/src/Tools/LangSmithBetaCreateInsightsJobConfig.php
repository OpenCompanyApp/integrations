<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * [Beta] Create Insights Job Config.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/sessions/{session_id}/insights/configs.
 */
class LangSmithBetaCreateInsightsJobConfig extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_beta_create_insights_job_config';
    protected const DESCRIPTION = '[Beta] Create Insights Job Config

Official endpoint: POST /api/v1/sessions/{session_id}/insights/configs
Save an insights job config.';
    protected const PARAMETERS = array (
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `session_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/sessions/{session_id}/insights/configs';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
