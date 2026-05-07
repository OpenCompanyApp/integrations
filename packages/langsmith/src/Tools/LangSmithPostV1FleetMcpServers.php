<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create MCP server.
 *
 * Maps to the official LangSmith endpoint POST /v1/fleet/mcp-servers.
 */
class LangSmithPostV1FleetMcpServers extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_fleet_mcp_servers';
    protected const DESCRIPTION = 'Create MCP server

Official endpoint: POST /v1/fleet/mcp-servers
Registers a new MCP server configuration for the workspace.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fleet/mcp-servers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
