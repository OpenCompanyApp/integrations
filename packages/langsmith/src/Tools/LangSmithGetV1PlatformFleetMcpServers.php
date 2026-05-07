<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List MCP servers.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/fleet/mcp-servers.
 */
class LangSmithGetV1PlatformFleetMcpServers extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_fleet_mcp_servers';
    protected const DESCRIPTION = 'List MCP servers

Official endpoint: GET /v1/platform/fleet/mcp-servers
Returns MCP servers visible to the caller after ABAC filtering. Service-key callers may pass X-Ls-User-Id to resolve per-user OAuth providers.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/fleet/mcp-servers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
