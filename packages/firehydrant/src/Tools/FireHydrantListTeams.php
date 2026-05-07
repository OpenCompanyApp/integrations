<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List teams.
 *
 * Maps to the official FireHydrant endpoint get /v1/teams.
 */
class FireHydrantListTeams extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_teams';
    protected const DESCRIPTION = 'List teams

Official FireHydrant endpoint: GET /v1/teams

List all of the teams in the organization';
    protected const PARAMETERS = array (
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
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A query to search teams by their name or description',
  ),
  'name' =>
  array (
    'type' => 'string',
    'description' => 'A query to search teams by their name',
  ),
  'services' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of service IDs',
  ),
  'default_incident_role' =>
  array (
    'type' => 'string',
    'description' => 'Filter by teams that have or do not have members with a default incident role asssigned. Value may be \'present\', \'blank\', or the ID of an incident role.',
  ),
  'lite' =>
  array (
    'type' => 'boolean',
    'description' => 'Boolean to determine whether to return a slimified version of the teams object',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/teams';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'query' => 'query',
  'name' => 'name',
  'services' => 'services',
  'default_incident_role' => 'default_incident_role',
  'lite' => 'lite',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
