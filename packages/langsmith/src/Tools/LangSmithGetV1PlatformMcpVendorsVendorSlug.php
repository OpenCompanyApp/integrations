<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get MCP vendor.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/mcp-vendors/{vendor_slug}.
 */
class LangSmithGetV1PlatformMcpVendorsVendorSlug extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_mcp_vendors_vendor_slug';
    protected const DESCRIPTION = 'Get MCP vendor

Official endpoint: GET /v1/platform/mcp-vendors/{vendor_slug}
Returns vendor metadata and current settings.';
    protected const PARAMETERS = array (
  'vendor_slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `vendor_slug`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/mcp-vendors/{vendor_slug}';
    protected const PATH_PARAMS = array (
  0 => 'vendor_slug',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
