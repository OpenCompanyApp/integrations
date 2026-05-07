<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List MCP servers for a vendor.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/mcp-vendors/{vendor_slug}/mcp-servers.
 */
class LangSmithGetV1PlatformMcpVendorsVendorSlugMcpServers extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_mcp_vendors_vendor_slug_mcp_servers';
    protected const DESCRIPTION = 'List MCP servers for a vendor

Official endpoint: GET /v1/platform/mcp-vendors/{vendor_slug}/mcp-servers
Returns the MCP gateways from the vendor for the workspace\'s configured org/project.';
    protected const PARAMETERS = array (
  'vendor_slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `vendor_slug`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, offset.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/mcp-vendors/{vendor_slug}/mcp-servers';
    protected const PATH_PARAMS = array (
  0 => 'vendor_slug',
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
