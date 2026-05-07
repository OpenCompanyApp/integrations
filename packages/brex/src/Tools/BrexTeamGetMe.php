<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get current user.
 *
 * Maps to the official Brex endpoint get /v2/users/me.
 */
class BrexTeamGetMe extends AbstractBrexTool
{
    protected const NAME = 'brex_team_get_me';
    protected const DESCRIPTION = 'Get current user

Official Brex endpoint: GET /v2/users/me

This endpoint returns the user associated with the OAuth2 access token.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/users/me';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
