<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Models Generate Answer.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+model}:generateAnswer.
 */
class GeminiModelsGenerateAnswer extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_models_generate_answer';
    protected const DESCRIPTION = 'Models Generate Answer

Official Google Gemini endpoint: POST /v1beta/{+model}:generateAnswer
Generates a grounded answer from the model given an input `GenerateAnswerRequest`.';
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
    'description' => 'JSON request body matching the official Gemini API `GenerateAnswerRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+model}:generateAnswer';
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
