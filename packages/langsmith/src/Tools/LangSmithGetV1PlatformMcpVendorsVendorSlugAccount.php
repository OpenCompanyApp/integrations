<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get vendor account.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/mcp-vendors/{vendor_slug}/account.
 */
class LangSmithGetV1PlatformMcpVendorsVendorSlugAccount extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_mcp_vendors_vendor_slug_account';
    protected const DESCRIPTION = 'Get vendor account

Official endpoint: GET /v1/platform/mcp-vendors/{vendor_slug}/account
Resolves OAuth token and returns the vendor\'s account info.';
    protected const PARAMETERS = array (
  'vendor_slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `vendor_slug`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/mcp-vendors/{vendor_slug}/account';
    protected const PATH_PARAMS = array (
  0 => 'vendor_slug',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
