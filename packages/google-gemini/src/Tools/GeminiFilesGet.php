<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Files Get.
 *
 * Maps to the official Gemini endpoint GET /v1beta/{+name}.
 */
class GeminiFilesGet extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_files_get';
    protected const DESCRIPTION = 'Files Get

Official Google Gemini endpoint: GET /v1beta/{+name}
Gets the metadata for the given `File`.';
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
