<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create vendor settings.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/mcp-vendors/{vendor_slug}/settings.
 */
class LangSmithPostV1PlatformMcpVendorsVendorSlugSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_mcp_vendors_vendor_slug_settings';
    protected const DESCRIPTION = 'Create vendor settings

Official endpoint: POST /v1/platform/mcp-vendors/{vendor_slug}/settings
Initializes vendor settings.';
    protected const PARAMETERS = array (
  'vendor_slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `vendor_slug`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/mcp-vendors/{vendor_slug}/settings';
    protected const PATH_PARAMS = array (
  0 => 'vendor_slug',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
