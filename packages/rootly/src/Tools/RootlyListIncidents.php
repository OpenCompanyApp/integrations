<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List incidents.
 *
 * Maps to the official Rootly endpoint get /v1/incidents.
 */
class RootlyListIncidents extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_incidents';
    protected const DESCRIPTION = 'List incidents

Official Rootly endpoint: GET /v1/incidents

List incidents';
    protected const PARAMETERS = array (
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
  'filter_search' =>
  array (
    'type' => 'string',
    'description' => 'filter[search] parameter.',
  ),
  'filter_kind' =>
  array (
    'type' => 'string',
    'description' => 'filter[kind] parameter.',
  ),
  'filter_status' =>
  array (
    'type' => 'string',
    'description' => 'filter[status] parameter.',
  ),
  'filter_private' =>
  array (
    'type' => 'string',
    'description' => 'filter[private] parameter.',
  ),
  'filter_user_id' =>
  array (
    'type' => 'integer',
    'description' => 'filter[user_id] parameter.',
  ),
  'filter_severity' =>
  array (
    'type' => 'string',
    'description' => 'filter[severity] parameter.',
  ),
  'filter_severity_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[severity_id] parameter.',
  ),
  'filter_labels' =>
  array (
    'type' => 'string',
    'description' => 'filter[labels] parameter.',
  ),
  'filter_types' =>
  array (
    'type' => 'string',
    'description' => 'filter[types] parameter.',
  ),
  'filter_type_ids' =>
  array (
    'type' => 'string',
    'description' => 'filter[type_ids] parameter.',
  ),
  'filter_environments' =>
  array (
    'type' => 'string',
    'description' => 'filter[environments] parameter.',
  ),
  'filter_environment_ids' =>
  array (
    'type' => 'string',
    'description' => 'filter[environment_ids] parameter.',
  ),
  'filter_functionalities' =>
  array (
    'type' => 'string',
    'description' => 'filter[functionalities] parameter.',
  ),
  'filter_functionality_ids' =>
  array (
    'type' => 'string',
    'description' => 'filter[functionality_ids] parameter.',
  ),
  'filter_functionality_names' =>
  array (
    'type' => 'string',
    'description' => 'filter[functionality_names] parameter.',
  ),
  'filter_services' =>
  array (
    'type' => 'string',
    'description' => 'filter[services] parameter.',
  ),
  'filter_service_ids' =>
  array (
    'type' => 'string',
    'description' => 'filter[service_ids] parameter.',
  ),
  'filter_service_names' =>
  array (
    'type' => 'string',
    'description' => 'filter[service_names] parameter.',
  ),
  'filter_teams' =>
  array (
    'type' => 'string',
    'description' => 'filter[teams] parameter.',
  ),
  'filter_team_ids' =>
  array (
    'type' => 'string',
    'description' => 'filter[team_ids] parameter.',
  ),
  'filter_team_names' =>
  array (
    'type' => 'string',
    'description' => 'filter[team_names] parameter.',
  ),
  'filter_cause' =>
  array (
    'type' => 'string',
    'description' => 'filter[cause] parameter.',
  ),
  'filter_cause_ids' =>
  array (
    'type' => 'string',
    'description' => 'filter[cause_ids] parameter.',
  ),
  'filter_custom_field_selected_option_ids' =>
  array (
    'type' => 'string',
    'description' => 'filter[custom_field_selected_option_ids] parameter.',
  ),
  'filter_slack_channel_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[slack_channel_id] parameter.',
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
  'filter_detected_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[detected_at][gt] parameter.',
  ),
  'filter_detected_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[detected_at][gte] parameter.',
  ),
  'filter_detected_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[detected_at][lt] parameter.',
  ),
  'filter_detected_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[detected_at][lte] parameter.',
  ),
  'filter_acknowledged_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[acknowledged_at][gt] parameter.',
  ),
  'filter_acknowledged_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[acknowledged_at][gte] parameter.',
  ),
  'filter_acknowledged_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[acknowledged_at][lt] parameter.',
  ),
  'filter_acknowledged_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[acknowledged_at][lte] parameter.',
  ),
  'filter_mitigated_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[mitigated_at][gt] parameter.',
  ),
  'filter_mitigated_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[mitigated_at][gte] parameter.',
  ),
  'filter_mitigated_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[mitigated_at][lt] parameter.',
  ),
  'filter_mitigated_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[mitigated_at][lte] parameter.',
  ),
  'filter_resolved_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[resolved_at][gt] parameter.',
  ),
  'filter_resolved_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[resolved_at][gte] parameter.',
  ),
  'filter_resolved_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[resolved_at][lt] parameter.',
  ),
  'filter_resolved_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[resolved_at][lte] parameter.',
  ),
  'filter_closed_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[closed_at][gt] parameter.',
  ),
  'filter_closed_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[closed_at][gte] parameter.',
  ),
  'filter_closed_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[closed_at][lt] parameter.',
  ),
  'filter_closed_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[closed_at][lte] parameter.',
  ),
  'filter_in_triage_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[in_triage_at][gt] parameter.',
  ),
  'filter_in_triage_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[in_triage_at][gte] parameter.',
  ),
  'filter_in_triage_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[in_triage_at][lt] parameter.',
  ),
  'filter_in_triage_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[in_triage_at][lte] parameter.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: created_at,updated_at',
    'enum' =>
    array (
      0 => 'created_at',
      1 => '-created_at',
      2 => 'updated_at',
      3 => '-updated_at',
      4 => 'started_at',
      5 => '-started_at',
      6 => 'in_triage_at',
      7 => '-in_triage_at',
      8 => 'mitigated_at',
      9 => '-mitigated_at',
      10 => 'resolved_at',
      11 => '-resolved_at',
    ),
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: sub_statuses,causes,subscribers',
    'enum' =>
    array (
      0 => 'sub_statuses',
      1 => 'causes',
      2 => 'subscribers',
      3 => 'roles',
      4 => 'slack_messages',
      5 => 'environments',
      6 => 'incident_types',
      7 => 'services',
      8 => 'functionalities',
      9 => 'groups',
      10 => 'events',
      11 => 'action_items',
      12 => 'custom_field_selections',
      13 => 'feedbacks',
      14 => 'incident_post_mortem',
      15 => 'alerts',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[search]' => 'filter_search',
  'filter[kind]' => 'filter_kind',
  'filter[status]' => 'filter_status',
  'filter[private]' => 'filter_private',
  'filter[user_id]' => 'filter_user_id',
  'filter[severity]' => 'filter_severity',
  'filter[severity_id]' => 'filter_severity_id',
  'filter[labels]' => 'filter_labels',
  'filter[types]' => 'filter_types',
  'filter[type_ids]' => 'filter_type_ids',
  'filter[environments]' => 'filter_environments',
  'filter[environment_ids]' => 'filter_environment_ids',
  'filter[functionalities]' => 'filter_functionalities',
  'filter[functionality_ids]' => 'filter_functionality_ids',
  'filter[functionality_names]' => 'filter_functionality_names',
  'filter[services]' => 'filter_services',
  'filter[service_ids]' => 'filter_service_ids',
  'filter[service_names]' => 'filter_service_names',
  'filter[teams]' => 'filter_teams',
  'filter[team_ids]' => 'filter_team_ids',
  'filter[team_names]' => 'filter_team_names',
  'filter[cause]' => 'filter_cause',
  'filter[cause_ids]' => 'filter_cause_ids',
  'filter[custom_field_selected_option_ids]' => 'filter_custom_field_selected_option_ids',
  'filter[slack_channel_id]' => 'filter_slack_channel_id',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
  'filter[updated_at][gt]' => 'filter_updated_at_gt',
  'filter[updated_at][gte]' => 'filter_updated_at_gte',
  'filter[updated_at][lt]' => 'filter_updated_at_lt',
  'filter[updated_at][lte]' => 'filter_updated_at_lte',
  'filter[started_at][gt]' => 'filter_started_at_gt',
  'filter[started_at][gte]' => 'filter_started_at_gte',
  'filter[started_at][lt]' => 'filter_started_at_lt',
  'filter[started_at][lte]' => 'filter_started_at_lte',
  'filter[detected_at][gt]' => 'filter_detected_at_gt',
  'filter[detected_at][gte]' => 'filter_detected_at_gte',
  'filter[detected_at][lt]' => 'filter_detected_at_lt',
  'filter[detected_at][lte]' => 'filter_detected_at_lte',
  'filter[acknowledged_at][gt]' => 'filter_acknowledged_at_gt',
  'filter[acknowledged_at][gte]' => 'filter_acknowledged_at_gte',
  'filter[acknowledged_at][lt]' => 'filter_acknowledged_at_lt',
  'filter[acknowledged_at][lte]' => 'filter_acknowledged_at_lte',
  'filter[mitigated_at][gt]' => 'filter_mitigated_at_gt',
  'filter[mitigated_at][gte]' => 'filter_mitigated_at_gte',
  'filter[mitigated_at][lt]' => 'filter_mitigated_at_lt',
  'filter[mitigated_at][lte]' => 'filter_mitigated_at_lte',
  'filter[resolved_at][gt]' => 'filter_resolved_at_gt',
  'filter[resolved_at][gte]' => 'filter_resolved_at_gte',
  'filter[resolved_at][lt]' => 'filter_resolved_at_lt',
  'filter[resolved_at][lte]' => 'filter_resolved_at_lte',
  'filter[closed_at][gt]' => 'filter_closed_at_gt',
  'filter[closed_at][gte]' => 'filter_closed_at_gte',
  'filter[closed_at][lt]' => 'filter_closed_at_lt',
  'filter[closed_at][lte]' => 'filter_closed_at_lte',
  'filter[in_triage_at][gt]' => 'filter_in_triage_at_gt',
  'filter[in_triage_at][gte]' => 'filter_in_triage_at_gte',
  'filter[in_triage_at][lt]' => 'filter_in_triage_at_lt',
  'filter[in_triage_at][lte]' => 'filter_in_triage_at_lte',
  'sort' => 'sort',
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
