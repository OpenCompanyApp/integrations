<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Query Search.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/query/search.
 */
class GoogleCloudSearchQuerySearch extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_query_search';
    protected const DESCRIPTION = 'Query Search

Official Google Cloud Search endpoint: POST /v1/query/search
The Cloud Search Query API provides the search method, which returns the most relevant results from a user query.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Cloud Search `SearchRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/query/search';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
