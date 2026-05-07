<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

/**
 * Sites List.
 *
 * Maps to the official Search Console endpoint GET /webmasters/v3/sites.
 */
class GoogleSearchConsoleSitesList extends AbstractGoogleSearchConsoleTool
{
    protected const NAME = 'google_search_console_sites_list';
    protected const DESCRIPTION = 'Sites List

Official Google Search Console endpoint: GET /webmasters/v3/sites
Lists the user\'s Search Console sites.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/webmasters/v3/sites';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
