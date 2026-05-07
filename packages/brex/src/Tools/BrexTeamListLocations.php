<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List locations.
 *
 * Maps to the official Brex endpoint get /v2/locations.
 */
class BrexTeamListLocations extends AbstractBrexTool
{
    protected const NAME = 'brex_team_list_locations';
    protected const DESCRIPTION = 'List locations

Official Brex endpoint: GET /v2/locations

This endpoint lists all locations.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/locations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'name' => 'name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
