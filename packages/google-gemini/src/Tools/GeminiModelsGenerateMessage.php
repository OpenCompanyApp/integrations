<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Models Generate Message.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+model}:generateMessage.
 */
class GeminiModelsGenerateMessage extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_models_generate_message';
    protected const DESCRIPTION = 'Models Generate Message

Official Google Gemini endpoint: POST /v1beta/{+model}:generateMessage
Generates a response from the model given an input `MessagePrompt`.';
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
    'description' => 'JSON request body matching the official Gemini API `GenerateMessageRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+model}:generateMessage';
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
