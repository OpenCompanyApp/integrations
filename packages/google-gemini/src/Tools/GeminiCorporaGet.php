<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Corpora Get.
 *
 * Maps to the official Gemini endpoint GET /v1beta/{+name}.
 */
class GeminiCorporaGet extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_corpora_get';
    protected const DESCRIPTION = 'Corpora Get

Official Google Gemini endpoint: GET /v1beta/{+name}
Gets information about a specific `Corpus`.';
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
