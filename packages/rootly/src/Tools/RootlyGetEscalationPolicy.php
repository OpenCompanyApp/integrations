<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an escalation policy.
 *
 * Maps to the official Rootly endpoint get /v1/escalation_policies/{id}.
 */
class RootlyGetEscalationPolicy extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_escalation_policy';
    protected const DESCRIPTION = 'Retrieves an escalation policy

Official Rootly endpoint: GET /v1/escalation_policies/{id}

Retrieves a specific escalation policy by id';
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
    'description' => 'comma separated if needed. eg: escalation_policy_levels,escalation_policy_paths',
    'enum' =>
    array (
      0 => 'escalation_policy_levels',
      1 => 'escalation_policy_paths',
      2 => 'groups',
      3 => 'services',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/escalation_policies/{id}';
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
