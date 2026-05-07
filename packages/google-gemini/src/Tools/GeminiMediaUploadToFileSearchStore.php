<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Media Upload To File Search Store.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+fileSearchStoreName}:uploadToFileSearchStore.
 */
class GeminiMediaUploadToFileSearchStore extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_media_upload_to_file_search_store';
    protected const DESCRIPTION = 'Media Upload To File Search Store

Official Google Gemini endpoint: POST /v1beta/{+fileSearchStoreName}:uploadToFileSearchStore
Uploads data to a FileSearchStore, preprocesses and chunks before storing it in a FileSearchStore Document.';
    protected const PARAMETERS = array (
  'fileSearchStoreName' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `fileSearchStoreName` from the official Gemini API method.',
  ),
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
    protected const PATH = '/v1beta/{+fileSearchStoreName}:uploadToFileSearchStore';
    protected const PATH_PARAMS = array (
  0 => 'fileSearchStoreName',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'fileSearchStoreName',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = true;
    protected const MEDIA_UPLOAD_PATH = '/upload/v1beta/{+fileSearchStoreName}:uploadToFileSearchStore';
}
