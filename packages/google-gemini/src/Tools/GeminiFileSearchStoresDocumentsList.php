<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * File Search Stores Documents List.
 *
 * Maps to the official Gemini endpoint GET /v1beta/{+parent}/documents.
 */
class GeminiFileSearchStoresDocumentsList extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_file_search_stores_documents_list';
    protected const DESCRIPTION = 'File Search Stores Documents List

Official Google Gemini endpoint: GET /v1beta/{+parent}/documents
Lists all `Document`s in a `Corpus`.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the official Gemini API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Gemini method. Known keys: pageToken, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token, received from a previous `ListDocuments` call. Provide the `next_page_token` returned in the response as an argument to the next request to retrieve the next page. When paginating, all other parameters provided to `ListDocuments` must match the call that provided the page token.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. The maximum number of `Document`s to return (per page). The service may return fewer `Document`s. If unspecified, at most 10 `Document`s will be returned. The maximum size limit is 20 `Document`s per page.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1beta/{+parent}/documents';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
