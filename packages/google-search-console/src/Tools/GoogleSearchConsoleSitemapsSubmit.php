<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

/**
 * Sitemaps Submit.
 *
 * Maps to the official Search Console endpoint PUT /webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}.
 */
class GoogleSearchConsoleSitemapsSubmit extends AbstractGoogleSearchConsoleTool
{
    protected const NAME = 'google_search_console_sitemaps_submit';
    protected const DESCRIPTION = 'Sitemaps Submit

Official Google Search Console endpoint: PUT /webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}
Submits a sitemap for a site.';
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
    protected const METHOD = 'PUT';
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
