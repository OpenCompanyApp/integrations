<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get user.
 *
 * Maps to the official Brex endpoint get /v2/users/{id}.
 */
class BrexTeamGetUserById extends AbstractBrexTool
{
    protected const NAME = 'brex_team_get_user_by_id';
    protected const DESCRIPTION = 'Get user

Official Brex endpoint: GET /v2/users/{id}

This endpoint gets a user by ID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
