<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List escalation levels for an Escalation Policy.
 *
 * Maps to the official Rootly endpoint get /v1/escalation_policies/{escalation_policy_id}/escalation_levels.
 */
class RootlyListEscalationLevels extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_escalation_levels';
    protected const DESCRIPTION = 'List escalation levels for an Escalation Policy

Official Rootly endpoint: GET /v1/escalation_policies/{escalation_policy_id}/escalation_levels

List escalation levels';
    protected const PARAMETERS = array (
  'escalation_policy_id' =>
  array (
    'type' => 'string',
    'description' => 'escalation_policy_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
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
    protected const PATH = '/v1/escalation_policies/{escalation_policy_id}/escalation_levels';
    protected const PATH_PARAMS = array (
  'escalation_policy_id' => 'escalation_policy_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
