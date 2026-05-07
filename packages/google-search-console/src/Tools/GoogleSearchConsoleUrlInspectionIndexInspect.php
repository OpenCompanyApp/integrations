<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

/**
 * Url Inspection Index Inspect.
 *
 * Maps to the official Search Console endpoint POST /v1/urlInspection/index:inspect.
 */
class GoogleSearchConsoleUrlInspectionIndexInspect extends AbstractGoogleSearchConsoleTool
{
    protected const NAME = 'google_search_console_url_inspection_index_inspect';
    protected const DESCRIPTION = 'Url Inspection Index Inspect

Official Google Search Console endpoint: POST /v1/urlInspection/index:inspect
Index inspection.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Search Console API `InspectUrlIndexRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/urlInspection/index:inspect';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
