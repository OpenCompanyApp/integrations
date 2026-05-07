<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get MCP server.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/mcp-servers/{mcp_server_id}.
 */
class LangSmithGetV1FleetMcpServersMcpServerId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_mcp_servers_mcp_server_id';
    protected const DESCRIPTION = 'Get MCP server

Official endpoint: GET /v1/fleet/mcp-servers/{mcp_server_id}
Returns a single MCP server by ID.';
    protected const PARAMETERS = array (
  'mcp_server_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `mcp_server_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/mcp-servers/{mcp_server_id}';
    protected const PATH_PARAMS = array (
  0 => 'mcp_server_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
