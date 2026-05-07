<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Models Embed Content.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+model}:embedContent.
 */
class GeminiModelsEmbedContent extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_models_embed_content';
    protected const DESCRIPTION = 'Models Embed Content

Official Google Gemini endpoint: POST /v1beta/{+model}:embedContent
Generates a text embedding vector from the input `Content` using the specified [Gemini Embedding model](https://ai.google.dev/gemini-api/docs/models/gemini#text-embedding).';
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
    'description' => 'JSON request body matching the official Gemini API `EmbedContentRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+model}:embedContent';
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
