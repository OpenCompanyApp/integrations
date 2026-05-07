<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get limit for the user.
 *
 * Maps to the official Brex endpoint get /v2/users/{id}/limit.
 */
class BrexTeamGetUserLimit extends AbstractBrexTool
{
    protected const NAME = 'brex_team_get_user_limit';
    protected const DESCRIPTION = 'Get limit for the user

Official Brex endpoint: GET /v2/users/{id}/limit

This endpoint gets the monthly limit for the user including the monthly available limit.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/users/{id}/limit';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
