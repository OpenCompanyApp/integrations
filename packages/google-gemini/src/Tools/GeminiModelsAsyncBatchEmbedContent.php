<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Models Async Batch Embed Content.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+model}:asyncBatchEmbedContent.
 */
class GeminiModelsAsyncBatchEmbedContent extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_models_async_batch_embed_content';
    protected const DESCRIPTION = 'Models Async Batch Embed Content

Official Google Gemini endpoint: POST /v1beta/{+model}:asyncBatchEmbedContent
Enqueues a batch of `EmbedContent` requests for batch processing. We have a `BatchEmbedContents` handler in `GenerativeService`, but it was synchronized. So we name this one to be `Async` to avoid confusion.';
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
    'description' => 'JSON request body matching the official Gemini API `AsyncBatchEmbedContentRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+model}:asyncBatchEmbedContent';
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
