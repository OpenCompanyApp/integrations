<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * File Search Stores List.
 *
 * Maps to the official Gemini endpoint GET /v1beta/fileSearchStores.
 */
class GeminiFileSearchStoresList extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_file_search_stores_list';
    protected const DESCRIPTION = 'File Search Stores List

Official Google Gemini endpoint: GET /v1beta/fileSearchStores
Lists all `FileSearchStores` owned by the user.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Gemini method. Known keys: pageSize, pageToken.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. The maximum number of `FileSearchStores` to return (per page). The service may return fewer `FileSearchStores`. If unspecified, at most 10 `FileSearchStores` will be returned. The maximum size limit is 20 `FileSearchStores` per page.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token, received from a previous `ListFileSearchStores` call. Provide the `next_page_token` returned in the response as an argument to the next request to retrieve the next page. When paginating, all other parameters provided to `ListFileSearchStores` must match the call that provided the page token.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1beta/fileSearchStores';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
