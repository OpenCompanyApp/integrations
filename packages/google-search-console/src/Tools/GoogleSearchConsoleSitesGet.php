<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

/**
 * Sites Get.
 *
 * Maps to the official Search Console endpoint GET /webmasters/v3/sites/{siteUrl}.
 */
class GoogleSearchConsoleSitesGet extends AbstractGoogleSearchConsoleTool
{
    protected const NAME = 'google_search_console_sites_get';
    protected const DESCRIPTION = 'Sites Get

Official Google Search Console endpoint: GET /webmasters/v3/sites/{siteUrl}
Retrieves information about specific site.';
    protected const PARAMETERS = array (
  'siteUrl' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `siteUrl` from the official Search Console API method.',
  ),
);
    protected const METHOD = 'GET';
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
