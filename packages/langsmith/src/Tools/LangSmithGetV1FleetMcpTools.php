<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List MCP tools.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/mcp/tools.
 */
class LangSmithGetV1FleetMcpTools extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_mcp_tools';
    protected const DESCRIPTION = 'List MCP tools

Official endpoint: GET /v1/fleet/mcp/tools
Returns tools from a remote MCP server. Serves cached results when fresh, otherwise fetches from the remote server and caches the response.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: url, oauth_provider_id, force_refresh, ls_user_id.',
  ),
  'url' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `url`.',
  ),
  'oauth_provider_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `oauth_provider_id`.',
  ),
  'force_refresh' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `force_refresh`.',
  ),
  'ls_user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ls_user_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/mcp/tools';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'url',
  1 => 'oauth_provider_id',
  2 => 'force_refresh',
  3 => 'ls_user_id',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
