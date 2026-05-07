<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List on-calls.
 *
 * Maps to the official Rootly endpoint get /v1/oncalls.
 */
class RootlyListOncalls extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_oncalls';
    protected const DESCRIPTION = 'List on-calls

Official Rootly endpoint: GET /v1/oncalls

List who is currently on-call, with support for filtering by escalation policy, schedule, and user. Returns on-call entries grouped by escalation policy level.';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: user,schedule',
    'enum' =>
    array (
      0 => 'user',
      1 => 'schedule',
      2 => 'escalation_policy',
    ),
  ),
  'since' =>
  array (
    'type' => 'string',
    'description' => 'Start of time range in ISO-8601 format (e.g., 2025-01-01T00:00:00Z). Defaults to current time.',
  ),
  'until' =>
  array (
    'type' => 'string',
    'description' => 'End of time range in ISO-8601 format (e.g., 2025-01-01T00:00:00Z). Defaults to \'since\' time.',
  ),
  'earliest' =>
  array (
    'type' => 'boolean',
    'description' => 'When true, returns only the first on-call user per escalation policy level',
  ),
  'time_zone' =>
  array (
    'type' => 'string',
    'description' => 'Timezone for response times (e.g., America/New_York). Defaults to UTC.',
  ),
  'filter_escalation_policy_ids' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated escalation policy IDs',
  ),
  'filter_schedule_ids' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated schedule IDs',
  ),
  'filter_user_ids' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated user IDs',
  ),
  'filter_service_ids' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated service IDs',
  ),
  'filter_group_ids' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated group IDs (teams)',
  ),
  'filter_notification_types' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated notification types to include. One or both of: audible, quiet. When present, oncalls are returned from every non-deferral escalation path whose notification_type is in the filter, sorted audible-first. When absent, only the default path\'s oncalls are returned (existing behavior).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/oncalls';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'since' => 'since',
  'until' => 'until',
  'earliest' => 'earliest',
  'time_zone' => 'time_zone',
  'filter[escalation_policy_ids]' => 'filter_escalation_policy_ids',
  'filter[schedule_ids]' => 'filter_schedule_ids',
  'filter[user_ids]' => 'filter_user_ids',
  'filter[service_ids]' => 'filter_service_ids',
  'filter[group_ids]' => 'filter_group_ids',
  'filter[notification_types]' => 'filter_notification_types',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
