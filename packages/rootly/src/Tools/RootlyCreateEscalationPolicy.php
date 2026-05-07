<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an escalation policy.
 *
 * Maps to the official Rootly endpoint post /v1/escalation_policies.
 */
class RootlyCreateEscalationPolicy extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_escalation_policy';
    protected const DESCRIPTION = 'Creates an escalation policy

Official Rootly endpoint: POST /v1/escalation_policies

Creates a new escalation policy from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/escalation_policies';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
