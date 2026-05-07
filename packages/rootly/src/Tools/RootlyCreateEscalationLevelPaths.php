<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an escalation level for an Escalation Path.
 *
 * Maps to the official Rootly endpoint post /v1/escalation_paths/{escalation_policy_path_id}/escalation_levels.
 */
class RootlyCreateEscalationLevelPaths extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_escalation_level_paths';
    protected const DESCRIPTION = 'Creates an escalation level for an Escalation Path

Official Rootly endpoint: POST /v1/escalation_paths/{escalation_policy_path_id}/escalation_levels

Creates a new escalation level from provided data';
    protected const PARAMETERS = array (
  'escalation_policy_path_id' =>
  array (
    'type' => 'string',
    'description' => 'escalation_policy_path_id parameter.',
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
    protected const PATH = '/v1/escalation_paths/{escalation_policy_path_id}/escalation_levels';
    protected const PATH_PARAMS = array (
  'escalation_policy_path_id' => 'escalation_policy_path_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
