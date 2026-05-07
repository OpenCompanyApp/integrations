<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Files Register.
 *
 * Maps to the official Gemini endpoint POST /v1beta/files:register.
 */
class GeminiFilesRegister extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_files_register';
    protected const DESCRIPTION = 'Files Register

Official Google Gemini endpoint: POST /v1beta/files:register
Registers a Google Cloud Storage files with FileService. The user is expected to provide Google Cloud Storage URIs and will receive a File resource for each URI in return. Note that the files are not copied, just registered with File API. If one file fails to register, the whole request fails.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `RegisterFilesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/files:register';
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
