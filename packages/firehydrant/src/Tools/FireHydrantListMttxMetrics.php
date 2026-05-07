<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get infrastructure metrics.
 *
 * Maps to the official FireHydrant endpoint get /v1/metrics/mttx.
 */
class FireHydrantListMttxMetrics extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_mttx_metrics';
    protected const DESCRIPTION = 'Get infrastructure metrics

Official FireHydrant endpoint: GET /v1/metrics/mttx

Fetch infrastructure metrics based on custom query';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
  'conditions' =>
  array (
    'type' => 'string',
    'description' => 'A JSON string that defines \'logic\' and \'user_data\'',
  ),
  'environments' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of environment IDs or \'is_empty\' to filter for incidents with no impacted environments',
  ),
  'services' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of service IDs or \'is_empty\' to filter for incidents with no impacted services',
  ),
  'functionalities' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of functionality IDs or \'is_empty\' to filter for incidents with no impacted functionalities',
  ),
  'excluded_infrastructure_ids' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of infrastructure IDs. Returns incidents that do not have the following infrastructure ids associated with them.',
  ),
  'teams' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of team IDs',
  ),
  'assigned_teams' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of IDs for assigned teams or \'is_empty\' to filter for incidents with no active team assignments',
  ),
  'status' =>
  array (
    'type' => 'string',
    'description' => 'Incident status',
  ),
  'start_date' =>
  array (
    'type' => 'string',
    'description' => 'Filters for incidents that started on or after this date',
    'required' => true,
  ),
  'end_date' =>
  array (
    'type' => 'string',
    'description' => 'Filters for incidents that started on or before this date',
    'required' => true,
  ),
  'resolved_at_or_after' =>
  array (
    'type' => 'string',
    'description' => 'Filters for incidents that were resolved at or after this time. Combine this with the `current_milestones` parameter if you wish to omit incidents that were re-opened and are still active.',
  ),
  'resolved_at_or_before' =>
  array (
    'type' => 'string',
    'description' => 'Filters for incidents that were resolved at or before this time. Combine this with the `current_milestones` parameter if you wish to omit incidents that were re-opened and are still active.',
  ),
  'closed_at_or_after' =>
  array (
    'type' => 'string',
    'description' => 'Filters for incidents that were closed at or after this time',
  ),
  'closed_at_or_before' =>
  array (
    'type' => 'string',
    'description' => 'Filters for incidents that were closed at or before this time',
  ),
  'created_at_or_after' =>
  array (
    'type' => 'string',
    'description' => 'Filters for incidents that were created at or after this time',
  ),
  'created_at_or_before' =>
  array (
    'type' => 'string',
    'description' => 'Filters for incidents that were created at or before this time',
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A text query for an incident that searches on name, summary, and desciption',
  ),
  'name' =>
  array (
    'type' => 'string',
    'description' => 'A query to search incidents by their name',
  ),
  'saved_search_id' =>
  array (
    'type' => 'string',
    'description' => 'The id of a previously saved search.',
  ),
  'priorities' =>
  array (
    'type' => 'string',
    'description' => 'A text value of priority',
  ),
  'priority_not_set' =>
  array (
    'type' => 'boolean',
    'description' => 'Flag for including incidents where priority has not been set',
  ),
  'severities' =>
  array (
    'type' => 'string',
    'description' => 'A text value of severity',
  ),
  'severity_not_set' =>
  array (
    'type' => 'boolean',
    'description' => 'Flag for including incidents where severity has not been set',
  ),
  'current_milestones' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of current milestones',
  ),
  'tags' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of tags',
  ),
  'tag_match_strategy' =>
  array (
    'type' => 'string',
    'description' => 'A matching strategy for the tags provided',
    'enum' =>
    array (
      0 => 'any',
      1 => 'match_all',
      2 => 'exclude',
    ),
  ),
  'archived' =>
  array (
    'type' => 'boolean',
    'description' => 'Return archived incidents',
  ),
  'updated_after' =>
  array (
    'type' => 'string',
    'description' => 'Filters for incidents that were updated after this date',
  ),
  'updated_before' =>
  array (
    'type' => 'string',
    'description' => 'Filters for incidents that were updated before this date',
  ),
  'incident_type_id' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of incident type IDs or \'is_empty\' to filter for incidents with no incident type',
  ),
  'custom_fields_field_id' =>
  array (
    'type' => 'array',
    'description' => 'Custom field ID to filter on',
  ),
  'custom_fields_value' =>
  array (
    'type' => 'array',
    'description' => 'Custom field value (empty means no value set)',
  ),
  'retrospective_templates' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of retrospective template IDs',
  ),
  'attached_runbooks' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of runbook IDs',
  ),
  'custom_field_id' =>
  array (
    'type' => 'string',
    'description' => 'custom_field_id parameter.',
  ),
  'sort_by' =>
  array (
    'type' => 'string',
    'description' => 'sort_by parameter.',
    'enum' =>
    array (
      0 => 'count_asc',
      1 => 'mttr_asc',
      2 => 'mtta_asc',
      3 => 'mttd_asc',
      4 => 'mttm_asc',
      5 => 'healthiness_asc',
      6 => 'count_desc',
      7 => 'mttr_desc',
      8 => 'mtta_desc',
      9 => 'mttd_desc',
      10 => 'mttm_desc',
      11 => 'healthiness_desc',
    ),
  ),
  'measurements' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of measurements to include in the response',
  ),
  'labels' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of label key / values in the format of \'key=value,key2=value2\'',
  ),
  'incident_openers' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of user IDs for the incident openers',
  ),
  'ticket_status' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of ticket status states',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/metrics/mttx';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'conditions' => 'conditions',
  'environments' => 'environments',
  'services' => 'services',
  'functionalities' => 'functionalities',
  'excluded_infrastructure_ids' => 'excluded_infrastructure_ids',
  'teams' => 'teams',
  'assigned_teams' => 'assigned_teams',
  'status' => 'status',
  'start_date' => 'start_date',
  'end_date' => 'end_date',
  'resolved_at_or_after' => 'resolved_at_or_after',
  'resolved_at_or_before' => 'resolved_at_or_before',
  'closed_at_or_after' => 'closed_at_or_after',
  'closed_at_or_before' => 'closed_at_or_before',
  'created_at_or_after' => 'created_at_or_after',
  'created_at_or_before' => 'created_at_or_before',
  'query' => 'query',
  'name' => 'name',
  'saved_search_id' => 'saved_search_id',
  'priorities' => 'priorities',
  'priority_not_set' => 'priority_not_set',
  'severities' => 'severities',
  'severity_not_set' => 'severity_not_set',
  'current_milestones' => 'current_milestones',
  'tags' => 'tags',
  'tag_match_strategy' => 'tag_match_strategy',
  'archived' => 'archived',
  'updated_after' => 'updated_after',
  'updated_before' => 'updated_before',
  'incident_type_id' => 'incident_type_id',
  'custom_fields[field_id]' => 'custom_fields_field_id',
  'custom_fields[value]' => 'custom_fields_value',
  'retrospective_templates' => 'retrospective_templates',
  'attached_runbooks' => 'attached_runbooks',
  'custom_field_id' => 'custom_field_id',
  'sort_by' => 'sort_by',
  'measurements' => 'measurements',
  'labels' => 'labels',
  'incident_openers' => 'incident_openers',
  'ticket_status' => 'ticket_status',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
