<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update an alert rule.
 *
 * Maps to the official LangSmith endpoint PATCH /v1/platform/alerts/{session_id}/{alert_rule_id}.
 */
class LangSmithPatchV1PlatformAlertsSessionIdAlertRuleId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_v1_platform_alerts_session_id_alert_rule_id';
    protected const DESCRIPTION = 'Update an alert rule

Official endpoint: PATCH /v1/platform/alerts/{session_id}/{alert_rule_id}
Updates an alert rule.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/platform/alerts/{session_id}/{alert_rule_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
  1 => 'alert_rule_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
