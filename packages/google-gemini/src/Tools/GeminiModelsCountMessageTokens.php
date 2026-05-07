<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Models Count Message Tokens.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+model}:countMessageTokens.
 */
class GeminiModelsCountMessageTokens extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_models_count_message_tokens';
    protected const DESCRIPTION = 'Models Count Message Tokens

Official Google Gemini endpoint: POST /v1beta/{+model}:countMessageTokens
Runs a model\'s tokenizer on a string and returns the token count.';
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
    'description' => 'JSON request body matching the official Gemini API `CountMessageTokensRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+model}:countMessageTokens';
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
