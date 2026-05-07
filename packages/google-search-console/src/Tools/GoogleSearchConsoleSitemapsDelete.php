<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

/**
 * Sitemaps Delete.
 *
 * Maps to the official Search Console endpoint DELETE /webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}.
 */
class GoogleSearchConsoleSitemapsDelete extends AbstractGoogleSearchConsoleTool
{
    protected const NAME = 'google_search_console_sitemaps_delete';
    protected const DESCRIPTION = 'Sitemaps Delete

Official Google Search Console endpoint: DELETE /webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}
Deletes a sitemap from the Sitemaps report. Does not stop Google from crawling this sitemap or the URLs that were previously crawled in the deleted sitemap.';
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
    protected const METHOD = 'DELETE';
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
