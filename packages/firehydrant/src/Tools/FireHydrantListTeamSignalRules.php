<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List Signals rules.
 *
 * Maps to the official FireHydrant endpoint get /v1/teams/{team_id}/signal_rules.
 */
class FireHydrantListTeamSignalRules extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_team_signal_rules';
    protected const DESCRIPTION = 'List Signals rules

Official FireHydrant endpoint: GET /v1/teams/{team_id}/signal_rules

List all Signals rules for a team.';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'team_id parameter.',
    'required' => true,
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A query string for searching through the list of alerting rules.',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/teams/{team_id}/signal_rules';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
