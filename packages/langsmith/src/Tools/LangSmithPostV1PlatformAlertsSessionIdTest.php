<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Test an alert action to determine if configuration is valid.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/alerts/{session_id}/test.
 */
class LangSmithPostV1PlatformAlertsSessionIdTest extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_alerts_session_id_test';
    protected const DESCRIPTION = 'Test an alert action to determine if configuration is valid

Official endpoint: POST /v1/platform/alerts/{session_id}/test
Tests an alert action which will fire a notification to all configured recipients if the configuration is valid.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/alerts/{session_id}/test';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
  1 => 'alert_rule_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
