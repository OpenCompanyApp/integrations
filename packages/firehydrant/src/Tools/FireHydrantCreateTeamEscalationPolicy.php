<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create an escalation policy for a team.
 *
 * Maps to the official FireHydrant endpoint post /v1/teams/{team_id}/escalation_policies.
 */
class FireHydrantCreateTeamEscalationPolicy extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_team_escalation_policy';
    protected const DESCRIPTION = 'Create an escalation policy for a team

Official FireHydrant endpoint: POST /v1/teams/{team_id}/escalation_policies

Create a Signals escalation policy for a team.';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'team_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/teams/{team_id}/escalation_policies';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
