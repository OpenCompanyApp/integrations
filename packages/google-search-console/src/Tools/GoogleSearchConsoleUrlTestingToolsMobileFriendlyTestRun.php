<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

/**
 * Url Testing Tools Mobile Friendly Test Run.
 *
 * Maps to the official Search Console endpoint POST /v1/urlTestingTools/mobileFriendlyTest:run.
 */
class GoogleSearchConsoleUrlTestingToolsMobileFriendlyTestRun extends AbstractGoogleSearchConsoleTool
{
    protected const NAME = 'google_search_console_url_testing_tools_mobile_friendly_test_run';
    protected const DESCRIPTION = 'Url Testing Tools Mobile Friendly Test Run

Official Google Search Console endpoint: POST /v1/urlTestingTools/mobileFriendlyTest:run
Runs Mobile-Friendly Test for a given URL.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Search Console API `RunMobileFriendlyTestRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/urlTestingTools/mobileFriendlyTest:run';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
