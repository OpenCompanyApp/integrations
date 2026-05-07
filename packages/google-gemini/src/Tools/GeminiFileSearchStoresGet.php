<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * File Search Stores Get.
 *
 * Maps to the official Gemini endpoint GET /v1beta/{+name}.
 */
class GeminiFileSearchStoresGet extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_file_search_stores_get';
    protected const DESCRIPTION = 'File Search Stores Get

Official Google Gemini endpoint: GET /v1beta/{+name}
Gets information about a specific `FileSearchStore`.';
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
