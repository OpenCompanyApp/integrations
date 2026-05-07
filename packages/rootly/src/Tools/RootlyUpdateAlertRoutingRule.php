<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an alert routing rule.
 *
 * Maps to the official Rootly endpoint put /v1/alert_routing_rules/{id}.
 */
class RootlyUpdateAlertRoutingRule extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_alert_routing_rule';
    protected const DESCRIPTION = 'Update an alert routing rule

Official Rootly endpoint: PUT /v1/alert_routing_rules/{id}

Update a specific alert routing rule by id. **Note: If you are an advanced alert routing user, you should use the Alert Routes endpoint instead of this endpoint. If you don\'t know whether you are an advanced user, please contact Rootly customer support.**';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/alert_routing_rules/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
