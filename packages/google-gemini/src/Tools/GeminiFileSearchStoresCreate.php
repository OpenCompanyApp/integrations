<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * File Search Stores Create.
 *
 * Maps to the official Gemini endpoint POST /v1beta/fileSearchStores.
 */
class GeminiFileSearchStoresCreate extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_file_search_stores_create';
    protected const DESCRIPTION = 'File Search Stores Create

Official Google Gemini endpoint: POST /v1beta/fileSearchStores
Creates an empty `FileSearchStore`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `FileSearchStore` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/fileSearchStores';
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
