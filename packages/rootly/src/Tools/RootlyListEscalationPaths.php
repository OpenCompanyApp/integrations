<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List escalation paths.
 *
 * Maps to the official Rootly endpoint get /v1/escalation_policies/{escalation_policy_id}/escalation_paths.
 */
class RootlyListEscalationPaths extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_escalation_paths';
    protected const DESCRIPTION = 'List escalation paths

Official Rootly endpoint: GET /v1/escalation_policies/{escalation_policy_id}/escalation_paths

List escalation paths';
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
    'description' => 'comma separated if needed. eg: escalation_policy_levels',
    'enum' =>
    array (
      0 => 'escalation_policy_levels',
    ),
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
    protected const PATH = '/v1/escalation_policies/{escalation_policy_id}/escalation_paths';
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
