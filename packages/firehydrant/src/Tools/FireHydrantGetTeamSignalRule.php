<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a Signals rule.
 *
 * Maps to the official FireHydrant endpoint get /v1/teams/{team_id}/signal_rules/{id}.
 */
class FireHydrantGetTeamSignalRule extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_team_signal_rule';
    protected const DESCRIPTION = 'Get a Signals rule

Official FireHydrant endpoint: GET /v1/teams/{team_id}/signal_rules/{id}

Get a Signals rule by ID.';
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
    protected const PATH = '/v1/teams/{team_id}/signal_rules/{id}';
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
