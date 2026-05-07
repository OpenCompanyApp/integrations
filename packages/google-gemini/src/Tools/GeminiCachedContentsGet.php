<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Cached Contents Get.
 *
 * Maps to the official Gemini endpoint GET /v1beta/{+name}.
 */
class GeminiCachedContentsGet extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_cached_contents_get';
    protected const DESCRIPTION = 'Cached Contents Get

Official Google Gemini endpoint: GET /v1beta/{+name}
Reads CachedContent resource.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Gemini API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1beta/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
