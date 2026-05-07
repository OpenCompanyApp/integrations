<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create an alert rule.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/alerts/{session_id}.
 */
class LangSmithPostV1PlatformAlertsSessionId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_alerts_session_id';
    protected const DESCRIPTION = 'Create an alert rule

Official endpoint: POST /v1/platform/alerts/{session_id}
Creates a new alert rule. The request body must be a JSON-encoded alert rule object that follows the CreateAlertRuleRequest schema.';
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
    protected const PATH = '/v1/platform/alerts/{session_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
