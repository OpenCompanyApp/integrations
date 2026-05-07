<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an alert routing rule.
 *
 * Maps to the official Rootly endpoint delete /v1/alert_routing_rules/{id}.
 */
class RootlyDeleteAlertRoutingRule extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_alert_routing_rule';
    protected const DESCRIPTION = 'Delete an alert routing rule

Official Rootly endpoint: DELETE /v1/alert_routing_rules/{id}

Delete a specific alert routing rule by id. **Note: If you are an advanced alert routing user, you should use the Alert Routes endpoint instead of this endpoint. If you don\'t know whether you are an advanced user, please contact Rootly customer support.**';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/alert_routing_rules/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
