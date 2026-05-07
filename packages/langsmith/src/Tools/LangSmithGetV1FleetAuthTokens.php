<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List your connection tokens.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/auth-tokens.
 */
class LangSmithGetV1FleetAuthTokens extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_auth_tokens';
    protected const DESCRIPTION = 'List your connection tokens

Official endpoint: GET /v1/fleet/auth-tokens
Lists the active OAuth tokens belonging to the caller. Optionally filter by provider or agent.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: provider_id, agent_id.',
  ),
  'provider_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `provider_id`.',
  ),
  'agent_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `agent_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/auth-tokens';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'provider_id',
  1 => 'agent_id',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
