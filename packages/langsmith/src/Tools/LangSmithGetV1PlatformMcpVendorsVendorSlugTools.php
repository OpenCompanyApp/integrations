<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List tools for a vendor.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/mcp-vendors/{vendor_slug}/tools.
 */
class LangSmithGetV1PlatformMcpVendorsVendorSlugTools extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_mcp_vendors_vendor_slug_tools';
    protected const DESCRIPTION = 'List tools for a vendor

Official endpoint: GET /v1/platform/mcp-vendors/{vendor_slug}/tools
Returns the tool catalog for this vendor.';
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
    protected const PATH = '/v1/platform/mcp-vendors/{vendor_slug}/tools';
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
