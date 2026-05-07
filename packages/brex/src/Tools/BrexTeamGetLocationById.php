<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get location.
 *
 * Maps to the official Brex endpoint get /v2/locations/{id}.
 */
class BrexTeamGetLocationById extends AbstractBrexTool
{
    protected const NAME = 'brex_team_get_location_by_id';
    protected const DESCRIPTION = 'Get location

Official Brex endpoint: GET /v2/locations/{id}

This endpoint gets a location by ID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/locations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
