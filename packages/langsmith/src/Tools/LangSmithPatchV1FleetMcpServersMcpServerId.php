<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update MCP server.
 *
 * Maps to the official LangSmith endpoint PATCH /v1/fleet/mcp-servers/{mcp_server_id}.
 */
class LangSmithPatchV1FleetMcpServersMcpServerId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_v1_fleet_mcp_servers_mcp_server_id';
    protected const DESCRIPTION = 'Update MCP server

Official endpoint: PATCH /v1/fleet/mcp-servers/{mcp_server_id}
Partially updates an MCP server. Tool list cache is invalidated on success.';
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
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/fleet/mcp-servers/{mcp_server_id}';
    protected const PATH_PARAMS = array (
  0 => 'mcp_server_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
