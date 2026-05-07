<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

/**
 * Sites Delete.
 *
 * Maps to the official Search Console endpoint DELETE /webmasters/v3/sites/{siteUrl}.
 */
class GoogleSearchConsoleSitesDelete extends AbstractGoogleSearchConsoleTool
{
    protected const NAME = 'google_search_console_sites_delete';
    protected const DESCRIPTION = 'Sites Delete

Official Google Search Console endpoint: DELETE /webmasters/v3/sites/{siteUrl}
Removes a site from the set of the user\'s Search Console sites.';
    protected const PARAMETERS = array (
  'siteUrl' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `siteUrl` from the official Search Console API method.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/webmasters/v3/sites/{siteUrl}';
    protected const PATH_PARAMS = array (
  0 => 'siteUrl',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
