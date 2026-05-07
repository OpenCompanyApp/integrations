<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an escalation policy.
 *
 * Maps to the official Rootly endpoint delete /v1/escalation_policies/{id}.
 */
class RootlyDeleteEscalationPolicy extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_escalation_policy';
    protected const DESCRIPTION = 'Delete an escalation policy

Official Rootly endpoint: DELETE /v1/escalation_policies/{id}

Delete a specific escalation policy by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/escalation_policies/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
