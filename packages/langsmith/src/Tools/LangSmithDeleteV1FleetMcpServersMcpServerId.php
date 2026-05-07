<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete MCP server.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/fleet/mcp-servers/{mcp_server_id}.
 */
class LangSmithDeleteV1FleetMcpServersMcpServerId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_fleet_mcp_servers_mcp_server_id';
    protected const DESCRIPTION = 'Delete MCP server

Official endpoint: DELETE /v1/fleet/mcp-servers/{mcp_server_id}
Deletes an MCP server configuration.';
    protected const PARAMETERS = array (
  'mcp_server_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `mcp_server_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/fleet/mcp-servers/{mcp_server_id}';
    protected const PATH_PARAMS = array (
  0 => 'mcp_server_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
