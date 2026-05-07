<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List alerts.
 *
 * Maps to the official Rootly endpoint get /v1/alerts.
 */
class RootlyListAlerts extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_alerts';
    protected const DESCRIPTION = 'List alerts

Official Rootly endpoint: GET /v1/alerts

List alerts';
    protected const PARAMETERS = array (
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
  'filter_status' =>
  array (
    'type' => 'string',
    'description' => 'filter[status] parameter.',
  ),
  'filter_source' =>
  array (
    'type' => 'string',
    'description' => 'filter[source] parameter.',
  ),
  'filter_services' =>
  array (
    'type' => 'string',
    'description' => 'filter[services] parameter.',
  ),
  'filter_environments' =>
  array (
    'type' => 'string',
    'description' => 'filter[environments] parameter.',
  ),
  'filter_groups' =>
  array (
    'type' => 'string',
    'description' => 'filter[groups] parameter.',
  ),
  'filter_labels' =>
  array (
    'type' => 'string',
    'description' => 'filter[labels] parameter.',
  ),
  'filter_started_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[started_at][gt] parameter.',
  ),
  'filter_started_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[started_at][gte] parameter.',
  ),
  'filter_started_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[started_at][lt] parameter.',
  ),
  'filter_started_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[started_at][lte] parameter.',
  ),
  'filter_ended_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[ended_at][gt] parameter.',
  ),
  'filter_ended_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[ended_at][gte] parameter.',
  ),
  'filter_ended_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[ended_at][lt] parameter.',
  ),
  'filter_ended_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[ended_at][lte] parameter.',
  ),
  'filter_created_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][gt] parameter.',
  ),
  'filter_created_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][gte] parameter.',
  ),
  'filter_created_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][lt] parameter.',
  ),
  'filter_created_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][lte] parameter.',
  ),
  'filter_updated_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[updated_at][gt] parameter.',
  ),
  'filter_updated_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[updated_at][gte] parameter.',
  ),
  'filter_updated_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[updated_at][lt] parameter.',
  ),
  'filter_updated_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[updated_at][lte] parameter.',
  ),
  'page_after' =>
  array (
    'type' => 'string',
    'description' => 'The cursor to fetch results using cursor pagination. A cursor is provided in meta.next_cursor in the response.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alerts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'filter[status]' => 'filter_status',
  'filter[source]' => 'filter_source',
  'filter[services]' => 'filter_services',
  'filter[environments]' => 'filter_environments',
  'filter[groups]' => 'filter_groups',
  'filter[labels]' => 'filter_labels',
  'filter[started_at][gt]' => 'filter_started_at_gt',
  'filter[started_at][gte]' => 'filter_started_at_gte',
  'filter[started_at][lt]' => 'filter_started_at_lt',
  'filter[started_at][lte]' => 'filter_started_at_lte',
  'filter[ended_at][gt]' => 'filter_ended_at_gt',
  'filter[ended_at][gte]' => 'filter_ended_at_gte',
  'filter[ended_at][lt]' => 'filter_ended_at_lt',
  'filter[ended_at][lte]' => 'filter_ended_at_lte',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
  'filter[updated_at][gt]' => 'filter_updated_at_gt',
  'filter[updated_at][gte]' => 'filter_updated_at_gte',
  'filter[updated_at][lt]' => 'filter_updated_at_lt',
  'filter[updated_at][lte]' => 'filter_updated_at_lte',
  'page[after]' => 'page_after',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
