<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a Signals rule.
 *
 * Maps to the official FireHydrant endpoint post /v1/teams/{team_id}/signal_rules.
 */
class FireHydrantCreateTeamSignalRule extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_team_signal_rule';
    protected const DESCRIPTION = 'Create a Signals rule

Official FireHydrant endpoint: POST /v1/teams/{team_id}/signal_rules

Create a Signals rule for a team. We support up to 2000 rules per organization.';
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
    protected const PATH = '/v1/teams/{team_id}/signal_rules';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
