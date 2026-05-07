<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an escalation path.
 *
 * Maps to the official Rootly endpoint get /v1/escalation_paths/{id}.
 */
class RootlyGetEscalationPath extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_escalation_path';
    protected const DESCRIPTION = 'Retrieves an escalation path

Official Rootly endpoint: GET /v1/escalation_paths/{id}

Retrieves a specific escalation path by id';
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
    'description' => 'comma separated if needed. eg: escalation_policy_levels',
    'enum' =>
    array (
      0 => 'escalation_policy_levels',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/escalation_paths/{id}';
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
