<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a Signals rule.
 *
 * Maps to the official FireHydrant endpoint delete /v1/teams/{team_id}/signal_rules/{id}.
 */
class FireHydrantDeleteTeamSignalRule extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_team_signal_rule';
    protected const DESCRIPTION = 'Delete a Signals rule

Official FireHydrant endpoint: DELETE /v1/teams/{team_id}/signal_rules/{id}

Delete a Signals rule by ID';
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
    protected const METHOD = 'delete';
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
