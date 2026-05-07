<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Models Stream Generate Content.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+model}:streamGenerateContent.
 */
class GeminiModelsStreamGenerateContent extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_models_stream_generate_content';
    protected const DESCRIPTION = 'Models Stream Generate Content

Official Google Gemini endpoint: POST /v1beta/{+model}:streamGenerateContent
Generates a [streamed response](https://ai.google.dev/gemini-api/docs/text-generation?lang=python#generate-a-text-stream) from the model given an input `GenerateContentRequest`.';
    protected const PARAMETERS = array (
  'model' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `model` from the official Gemini API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `GenerateContentRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+model}:streamGenerateContent';
    protected const PATH_PARAMS = array (
  0 => 'model',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'model',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
