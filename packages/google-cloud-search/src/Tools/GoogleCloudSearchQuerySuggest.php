<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Query Suggest.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/query/suggest.
 */
class GoogleCloudSearchQuerySuggest extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_query_suggest';
    protected const DESCRIPTION = 'Query Suggest

Official Google Cloud Search endpoint: POST /v1/query/suggest
Provides suggestions for autocompleting the query.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Cloud Search `SuggestRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/query/suggest';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
