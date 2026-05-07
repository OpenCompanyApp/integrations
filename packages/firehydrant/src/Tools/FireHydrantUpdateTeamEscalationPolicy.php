<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an escalation policy for a team.
 *
 * Maps to the official FireHydrant endpoint patch /v1/teams/{team_id}/escalation_policies/{id}.
 */
class FireHydrantUpdateTeamEscalationPolicy extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_team_escalation_policy';
    protected const DESCRIPTION = 'Update an escalation policy for a team

Official FireHydrant endpoint: PATCH /v1/teams/{team_id}/escalation_policies/{id}

Update a Signals escalation policy by ID';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/teams/{team_id}/escalation_policies/{id}';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
