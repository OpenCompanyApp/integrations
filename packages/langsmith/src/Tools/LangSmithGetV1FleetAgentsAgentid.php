<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get an agent.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/agents/{agentID}.
 */
class LangSmithGetV1FleetAgentsAgentid extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_agents_agentid';
    protected const DESCRIPTION = 'Get an agent

Official endpoint: GET /v1/fleet/agents/{agentID}
Returns the specified agent.';
    protected const PARAMETERS = array (
  'agentID' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `agentID`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/agents/{agentID}';
    protected const PATH_PARAMS = array (
  0 => 'agentID',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
