<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get OAuth2 authorization server metadata.
 *
 * Maps to the official LangSmith endpoint GET /.well-known/oauth-authorization-server.
 */
class LangSmithGetWellKnownOauthAuthorizationServer extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_well_known_oauth_authorization_server';
    protected const DESCRIPTION = 'Get OAuth2 authorization server metadata

Official endpoint: GET /.well-known/oauth-authorization-server
Returns OAuth2 authorization server metadata per RFC 8414, including supported endpoints, grant types, and response types.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/.well-known/oauth-authorization-server';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
