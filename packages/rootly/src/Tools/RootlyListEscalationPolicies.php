<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List escalation policies.
 *
 * Maps to the official Rootly endpoint get /v1/escalation_policies.
 */
class RootlyListEscalationPolicies extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_escalation_policies';
    protected const DESCRIPTION = 'List escalation policies

Official Rootly endpoint: GET /v1/escalation_policies

List escalation policies';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: escalation_policy_levels,escalation_policy_paths',
    'enum' =>
    array (
      0 => 'escalation_policy_levels',
      1 => 'escalation_policy_paths',
      2 => 'groups',
      3 => 'services',
    ),
  ),
  'filter_search' =>
  array (
    'type' => 'string',
    'description' => 'filter[search] parameter.',
  ),
  'filter_name' =>
  array (
    'type' => 'string',
    'description' => 'filter[name] parameter.',
  ),
  'filter_team_ids' =>
  array (
    'type' => 'string',
    'description' => 'Filter escalation policies by associated team IDs. Comma-separate multiple values.',
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
    protected const PATH = '/v1/escalation_policies';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'filter[search]' => 'filter_search',
  'filter[name]' => 'filter_name',
  'filter[team_ids]' => 'filter_team_ids',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
