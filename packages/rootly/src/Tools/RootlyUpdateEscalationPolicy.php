<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an escalation policy.
 *
 * Maps to the official Rootly endpoint put /v1/escalation_policies/{id}.
 */
class RootlyUpdateEscalationPolicy extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_escalation_policy';
    protected const DESCRIPTION = 'Update an escalation policy

Official Rootly endpoint: PUT /v1/escalation_policies/{id}

Update a specific escalation policy by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/escalation_policies/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
