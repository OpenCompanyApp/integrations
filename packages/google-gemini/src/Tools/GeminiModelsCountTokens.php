<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Models Count Tokens.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+model}:countTokens.
 */
class GeminiModelsCountTokens extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_models_count_tokens';
    protected const DESCRIPTION = 'Models Count Tokens

Official Google Gemini endpoint: POST /v1beta/{+model}:countTokens
Runs a model\'s tokenizer on input `Content` and returns the token count. Refer to the [tokens guide](https://ai.google.dev/gemini-api/docs/tokens) to learn more about tokens.';
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
    'description' => 'JSON request body matching the official Gemini API `CountTokensRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+model}:countTokens';
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
