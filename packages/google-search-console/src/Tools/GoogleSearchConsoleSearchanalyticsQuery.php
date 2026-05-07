<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

/**
 * Searchanalytics Query.
 *
 * Maps to the official Search Console endpoint POST /webmasters/v3/sites/{siteUrl}/searchAnalytics/query.
 */
class GoogleSearchConsoleSearchanalyticsQuery extends AbstractGoogleSearchConsoleTool
{
    protected const NAME = 'google_search_console_searchanalytics_query';
    protected const DESCRIPTION = 'Searchanalytics Query

Official Google Search Console endpoint: POST /webmasters/v3/sites/{siteUrl}/searchAnalytics/query
Query your data with filters and parameters that you define. Returns zero or more rows grouped by the row keys that you define. You must define a date range of one or more days. When date is one of the group by values, any days without data are omitted from the result list. If you need to know which days have data, issue a broad date range query grouped by date for any metric, and see which day rows are returned.';
    protected const PARAMETERS = array (
  'siteUrl' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `siteUrl` from the official Search Console API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Search Console API `SearchAnalyticsQueryRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/webmasters/v3/sites/{siteUrl}/searchAnalytics/query';
    protected const PATH_PARAMS = array (
  0 => 'siteUrl',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
