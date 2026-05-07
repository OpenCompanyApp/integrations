<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List event sources for Signals.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/event_sources.
 */
class FireHydrantListSignalsEventSources extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_signals_event_sources';
    protected const DESCRIPTION = 'List event sources for Signals

Official FireHydrant endpoint: GET /v1/signals/event_sources

List all Signals event sources for the authenticated user.';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'Team ID to send signals to directly',
  ),
  'escalation_policy_id' =>
  array (
    'type' => 'string',
    'description' => 'Escalation policy ID to send signals to directly. `team_id` is required if this is provided.',
  ),
  'on_call_schedule_id' =>
  array (
    'type' => 'string',
    'description' => 'On-call schedule ID to send signals to directly. `team_id` is required if this is provided.',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'User ID to send signals to directly',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/event_sources';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'team_id' => 'team_id',
  'escalation_policy_id' => 'escalation_policy_id',
  'on_call_schedule_id' => 'on_call_schedule_id',
  'user_id' => 'user_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
