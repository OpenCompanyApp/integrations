<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an alert routing rule.
 *
 * Maps to the official Rootly endpoint post /v1/alert_routing_rules.
 */
class RootlyCreateAlertRoutingRule extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_alert_routing_rule';
    protected const DESCRIPTION = 'Creates an alert routing rule

Official Rootly endpoint: POST /v1/alert_routing_rules

Creates a new alert routing rule from provided data. **Note: If you are an advanced alert routing user, you should use the Alert Routes endpoint instead of this endpoint. If you don\'t know whether you are an advanced user, please contact Rootly customer support.**';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/alert_routing_rules';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
