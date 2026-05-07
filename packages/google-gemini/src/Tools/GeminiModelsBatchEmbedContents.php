<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Models Batch Embed Contents.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+model}:batchEmbedContents.
 */
class GeminiModelsBatchEmbedContents extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_models_batch_embed_contents';
    protected const DESCRIPTION = 'Models Batch Embed Contents

Official Google Gemini endpoint: POST /v1beta/{+model}:batchEmbedContents
Generates multiple embedding vectors from the input `Content` which consists of a batch of strings represented as `EmbedContentRequest` objects.';
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
    'description' => 'JSON request body matching the official Gemini API `BatchEmbedContentsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+model}:batchEmbedContents';
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
