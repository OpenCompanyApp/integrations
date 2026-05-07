<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

/**
 * Sitemaps List.
 *
 * Maps to the official Search Console endpoint GET /webmasters/v3/sites/{siteUrl}/sitemaps.
 */
class GoogleSearchConsoleSitemapsList extends AbstractGoogleSearchConsoleTool
{
    protected const NAME = 'google_search_console_sitemaps_list';
    protected const DESCRIPTION = 'Sitemaps List

Official Google Search Console endpoint: GET /webmasters/v3/sites/{siteUrl}/sitemaps
Lists the [sitemaps-entries](/webmaster-tools/v3/sitemaps) submitted for this site, or included in the sitemap index file (if `sitemapIndex` is specified in the request).';
    protected const PARAMETERS = array (
  'siteUrl' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `siteUrl` from the official Search Console API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Search Console method. Known keys: sitemapIndex.',
  ),
  'sitemapIndex' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A URL of a site\'s sitemap index. For example: `http://www.example.com/sitemapindex.xml`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/webmasters/v3/sites/{siteUrl}/sitemaps';
    protected const PATH_PARAMS = array (
  0 => 'siteUrl',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'sitemapIndex',
);
    protected const BODY_REQUIRED = false;
}
