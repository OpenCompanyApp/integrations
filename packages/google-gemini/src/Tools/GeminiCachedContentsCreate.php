<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Cached Contents Create.
 *
 * Maps to the official Gemini endpoint POST /v1beta/cachedContents.
 */
class GeminiCachedContentsCreate extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_cached_contents_create';
    protected const DESCRIPTION = 'Cached Contents Create

Official Google Gemini endpoint: POST /v1beta/cachedContents
Creates CachedContent resource.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `CachedContent` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/cachedContents';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
