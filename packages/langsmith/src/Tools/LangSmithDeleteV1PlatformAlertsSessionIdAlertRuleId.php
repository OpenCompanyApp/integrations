<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete an alert rule.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/alerts/{session_id}/{alert_rule_id}.
 */
class LangSmithDeleteV1PlatformAlertsSessionIdAlertRuleId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_alerts_session_id_alert_rule_id';
    protected const DESCRIPTION = 'Delete an alert rule

Official endpoint: DELETE /v1/platform/alerts/{session_id}/{alert_rule_id}
Deletes an alert rule';
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
    protected const METHOD = 'DELETE';
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
