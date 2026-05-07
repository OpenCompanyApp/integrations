<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Get information about an access token, such as the token type, scopes, team, user, token creation date and time, and the user who created the token..
 *
 * Maps to the official Miro endpoint GET /v1/oauth-token.
 */
class MiroTokenInfo extends AbstractMiroTool
{
    protected const NAME = 'miro_token_info';
    protected const DESCRIPTION = 'Get information about an access token, such as the token type, scopes, team, user, token creation date and time, and the user who created the token.

Official Miro endpoint: GET /v1/oauth-token.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/oauth-token';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
