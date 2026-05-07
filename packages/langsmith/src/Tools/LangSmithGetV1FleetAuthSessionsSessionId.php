<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get an authorization session.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/auth-sessions/{session_id}.
 */
class LangSmithGetV1FleetAuthSessionsSessionId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_auth_sessions_session_id';
    protected const DESCRIPTION = 'Get an authorization session

Official endpoint: GET /v1/fleet/auth-sessions/{session_id}
Returns the current status of an in-flight authorization session. Poll until status is COMPLETED, or the session expires.';
    protected const PARAMETERS = array (
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `session_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/auth-sessions/{session_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
