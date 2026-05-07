<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

/**
 * Sites Add.
 *
 * Maps to the official Search Console endpoint PUT /webmasters/v3/sites/{siteUrl}.
 */
class GoogleSearchConsoleSitesAdd extends AbstractGoogleSearchConsoleTool
{
    protected const NAME = 'google_search_console_sites_add';
    protected const DESCRIPTION = 'Sites Add

Official Google Search Console endpoint: PUT /webmasters/v3/sites/{siteUrl}
Adds a site to the set of the user\'s sites in Search Console.';
    protected const PARAMETERS = array (
  'siteUrl' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `siteUrl` from the official Search Console API method.',
  ),
);
    protected const METHOD = 'PUT';
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
