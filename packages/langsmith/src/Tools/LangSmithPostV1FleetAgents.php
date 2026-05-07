<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create an agent.
 *
 * Maps to the official LangSmith endpoint POST /v1/fleet/agents.
 */
class LangSmithPostV1FleetAgents extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_fleet_agents';
    protected const DESCRIPTION = 'Create an agent

Official endpoint: POST /v1/fleet/agents
Creates an agent with optional initial file tree. Validation runs before any write; the call is atomic. Default response omits the full file tree — pass ?include=files to echo it back.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: include.',
  ),
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fleet/agents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'include',
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
