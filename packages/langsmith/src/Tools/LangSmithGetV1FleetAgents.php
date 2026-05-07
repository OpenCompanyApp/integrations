<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List agents.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/agents.
 */
class LangSmithGetV1FleetAgents extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_agents';
    protected const DESCRIPTION = 'List agents

Official endpoint: GET /v1/fleet/agents
Returns the agents accessible to the authenticated user.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/agents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
