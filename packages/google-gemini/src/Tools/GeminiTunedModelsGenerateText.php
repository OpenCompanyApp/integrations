<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Tuned Models Generate Text.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+model}:generateText.
 */
class GeminiTunedModelsGenerateText extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_tuned_models_generate_text';
    protected const DESCRIPTION = 'Tuned Models Generate Text

Official Google Gemini endpoint: POST /v1beta/{+model}:generateText
Generates a response from the model given an input message.';
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
    'description' => 'JSON request body matching the official Gemini API `GenerateTextRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+model}:generateText';
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
