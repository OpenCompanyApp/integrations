<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Media Upload.
 *
 * Maps to the official Gemini endpoint POST /v1beta/files.
 */
class GeminiMediaUpload extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_media_upload';
    protected const DESCRIPTION = 'Media Upload

Official Google Gemini endpoint: POST /v1beta/files
Creates a `File`.';
    protected const PARAMETERS = array (
  'file_path' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Local file path to upload to Gemini for this media endpoint.',
  ),
  'mime_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'MIME type for the uploaded file. Defaults to application/octet-stream.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Optional request metadata body for multipart uploads.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/files';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = true;
    protected const MEDIA_UPLOAD_PATH = '/upload/v1beta/files';
}
