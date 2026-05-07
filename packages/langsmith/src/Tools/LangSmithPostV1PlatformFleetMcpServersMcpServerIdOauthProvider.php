<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Register per-user MCP OAuth provider.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/fleet/mcp-servers/{mcp_server_id}/oauth-provider.
 */
class LangSmithPostV1PlatformFleetMcpServersMcpServerIdOauthProvider extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_fleet_mcp_servers_mcp_server_id_oauth_provider';
    protected const DESCRIPTION = 'Register per-user MCP OAuth provider

Official endpoint: POST /v1/platform/fleet/mcp-servers/{mcp_server_id}/oauth-provider
Discovers and registers an OAuth provider for a user against an MCP server configured with per-user dynamic client mode. Idempotent when a mapping already exists.';
    protected const PARAMETERS = array (
  'mcp_server_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `mcp_server_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/fleet/mcp-servers/{mcp_server_id}/oauth-provider';
    protected const PATH_PARAMS = array (
  0 => 'mcp_server_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
