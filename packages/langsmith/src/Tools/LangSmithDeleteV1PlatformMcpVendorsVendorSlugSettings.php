<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete vendor settings.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/mcp-vendors/{vendor_slug}/settings.
 */
class LangSmithDeleteV1PlatformMcpVendorsVendorSlugSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_mcp_vendors_vendor_slug_settings';
    protected const DESCRIPTION = 'Delete vendor settings

Official endpoint: DELETE /v1/platform/mcp-vendors/{vendor_slug}/settings
Removes vendor settings.';
    protected const PARAMETERS = array (
  'vendor_slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `vendor_slug`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/mcp-vendors/{vendor_slug}/settings';
    protected const PATH_PARAMS = array (
  0 => 'vendor_slug',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
