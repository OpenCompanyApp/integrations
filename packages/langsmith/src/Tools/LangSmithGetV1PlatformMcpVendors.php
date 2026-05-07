<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List MCP vendors.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/mcp-vendors.
 */
class LangSmithGetV1PlatformMcpVendors extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_mcp_vendors';
    protected const DESCRIPTION = 'List MCP vendors

Official endpoint: GET /v1/platform/mcp-vendors
Returns the catalog of available MCP vendors.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/mcp-vendors';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
