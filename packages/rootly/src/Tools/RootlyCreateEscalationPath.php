<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an escalation path.
 *
 * Maps to the official Rootly endpoint post /v1/escalation_policies/{escalation_policy_id}/escalation_paths.
 */
class RootlyCreateEscalationPath extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_escalation_path';
    protected const DESCRIPTION = 'Creates an escalation path

Official Rootly endpoint: POST /v1/escalation_policies/{escalation_policy_id}/escalation_paths

Creates a new escalation path from provided data';
    protected const PARAMETERS = array (
  'escalation_policy_id' =>
  array (
    'type' => 'string',
    'description' => 'escalation_policy_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/escalation_policies/{escalation_policy_id}/escalation_paths';
    protected const PATH_PARAMS = array (
  'escalation_policy_id' => 'escalation_policy_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
