<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an alert.
 *
 * Maps to the official Rootly endpoint get /v1/alerts/{id}.
 */
class RootlyGetAlert extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_alert';
    protected const DESCRIPTION = 'Retrieves an alert

Official Rootly endpoint: GET /v1/alerts/{id}

Retrieves a specific alert by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: environments,services,groups',
    'enum' =>
    array (
      0 => 'environments',
      1 => 'services',
      2 => 'groups',
      3 => 'responders',
      4 => 'incidents',
      5 => 'events',
      6 => 'alert_urgency',
      7 => 'heartbeat',
      8 => 'live_call_router',
      9 => 'alert_group',
      10 => 'group_leader_alert',
      11 => 'group_member_alerts',
      12 => 'alert_field_values',
      13 => 'alerting_targets',
      14 => 'escalation_policies',
      15 => 'alert_call_recording',
      16 => 'alert_urgency',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alerts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
