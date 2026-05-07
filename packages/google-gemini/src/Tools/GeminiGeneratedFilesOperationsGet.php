<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Generated Files Operations Get.
 *
 * Maps to the official Gemini endpoint GET /v1beta/{+name}.
 */
class GeminiGeneratedFilesOperationsGet extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_generated_files_operations_get';
    protected const DESCRIPTION = 'Generated Files Operations Get

Official Google Gemini endpoint: GET /v1beta/{+name}
Gets the latest state of a long-running operation. Clients can use this method to poll the operation result at intervals as recommended by the API service.';
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
