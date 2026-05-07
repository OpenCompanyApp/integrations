<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get an alert rule.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/alerts/{session_id}/{alert_rule_id}.
 */
class LangSmithGetV1PlatformAlertsSessionIdAlertRuleId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_alerts_session_id_alert_rule_id';
    protected const DESCRIPTION = 'Get an alert rule

Official endpoint: GET /v1/platform/alerts/{session_id}/{alert_rule_id}
Gets an alert rule.';
    protected const PARAMETERS = array (
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `session_id`.',
  ),
  'alert_rule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `alert_rule_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/alerts/{session_id}/{alert_rule_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
  1 => 'alert_rule_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
