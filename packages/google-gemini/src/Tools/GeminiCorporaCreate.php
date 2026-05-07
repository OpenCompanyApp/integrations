<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Corpora Create.
 *
 * Maps to the official Gemini endpoint POST /v1beta/corpora.
 */
class GeminiCorporaCreate extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_corpora_create';
    protected const DESCRIPTION = 'Corpora Create

Official Google Gemini endpoint: POST /v1beta/corpora
Creates an empty `Corpus`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `Corpus` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/corpora';
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
