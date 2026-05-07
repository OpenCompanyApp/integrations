<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * File Search Stores Import File.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+fileSearchStoreName}:importFile.
 */
class GeminiFileSearchStoresImportFile extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_file_search_stores_import_file';
    protected const DESCRIPTION = 'File Search Stores Import File

Official Google Gemini endpoint: POST /v1beta/{+fileSearchStoreName}:importFile
Imports a `File` from File Service to a `FileSearchStore`.';
    protected const PARAMETERS = array (
  'fileSearchStoreName' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `fileSearchStoreName` from the official Gemini API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `ImportFileRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+fileSearchStoreName}:importFile';
    protected const PATH_PARAMS = array (
  0 => 'fileSearchStoreName',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'fileSearchStoreName',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
