<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

/**
 * Sitemaps Get.
 *
 * Maps to the official Search Console endpoint GET /webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}.
 */
class GoogleSearchConsoleSitemapsGet extends AbstractGoogleSearchConsoleTool
{
    protected const NAME = 'google_search_console_sitemaps_get';
    protected const DESCRIPTION = 'Sitemaps Get

Official Google Search Console endpoint: GET /webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}
Retrieves information about a specific sitemap.';
    protected const PARAMETERS = array (
  'siteUrl' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `siteUrl` from the official Search Console API method.',
  ),
  'feedpath' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `feedpath` from the official Search Console API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}';
    protected const PATH_PARAMS = array (
  0 => 'siteUrl',
  1 => 'feedpath',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
