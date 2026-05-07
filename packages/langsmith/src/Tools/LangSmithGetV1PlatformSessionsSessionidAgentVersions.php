<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List agent versions for a project.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/sessions/{sessionID}/agent-versions.
 */
class LangSmithGetV1PlatformSessionsSessionidAgentVersions extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_sessions_sessionid_agent_versions';
    protected const DESCRIPTION = 'List agent versions for a project

Official endpoint: GET /v1/platform/sessions/{sessionID}/agent-versions
Returns all agent versions (commit SHAs) seen in the given tracing project, ordered by first_seen_at descending.';
    protected const PARAMETERS = array (
  'sessionID' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `sessionID`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/sessions/{sessionID}/agent-versions';
    protected const PATH_PARAMS = array (
  0 => 'sessionID',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
