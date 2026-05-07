<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an escalation policy for a team.
 *
 * Maps to the official FireHydrant endpoint get /v1/teams/{team_id}/escalation_policies/{id}.
 */
class FireHydrantGetTeamEscalationPolicy extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_team_escalation_policy';
    protected const DESCRIPTION = 'Get an escalation policy for a team

Official FireHydrant endpoint: GET /v1/teams/{team_id}/escalation_policies/{id}

Get a Signals escalation policy by ID';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'team_id parameter.',
    'required' => true,
  ),
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/teams/{team_id}/escalation_policies/{id}';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
