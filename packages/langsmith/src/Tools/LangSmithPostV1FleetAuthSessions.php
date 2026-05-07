<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Start an authorization session.
 *
 * Maps to the official LangSmith endpoint POST /v1/fleet/auth-sessions.
 */
class LangSmithPostV1FleetAuthSessions extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_fleet_auth_sessions';
    protected const DESCRIPTION = 'Start an authorization session

Official endpoint: POST /v1/fleet/auth-sessions
Initiates an OAuth flow for the caller. If the user is already authorized, returns a completed session that references an existing token. Otherwise, returns a pending session containing a verification URL the user must visit to complete authorization.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fleet/auth-sessions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
