<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Cached Contents List.
 *
 * Maps to the official Gemini endpoint GET /v1beta/cachedContents.
 */
class GeminiCachedContentsList extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_cached_contents_list';
    protected const DESCRIPTION = 'Cached Contents List

Official Google Gemini endpoint: GET /v1beta/cachedContents
Lists CachedContents.';
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
    'description' => 'Optional. The maximum number of cached contents to return. The service may return fewer than this value. If unspecified, some default (under maximum) number of items will be returned. The maximum value is 1000; values above 1000 will be coerced to 1000.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token, received from a previous `ListCachedContents` call. Provide this to retrieve the subsequent page. When paginating, all other parameters provided to `ListCachedContents` must match the call that provided the page token.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1beta/cachedContents';
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
