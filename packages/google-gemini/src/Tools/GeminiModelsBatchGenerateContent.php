<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Models Batch Generate Content.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+model}:batchGenerateContent.
 */
class GeminiModelsBatchGenerateContent extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_models_batch_generate_content';
    protected const DESCRIPTION = 'Models Batch Generate Content

Official Google Gemini endpoint: POST /v1beta/{+model}:batchGenerateContent
Enqueues a batch of `GenerateContent` requests for batch processing.';
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
    'description' => 'JSON request body matching the official Gemini API `BatchGenerateContentRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+model}:batchGenerateContent';
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
