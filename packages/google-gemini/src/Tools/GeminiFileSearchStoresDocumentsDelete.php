<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * File Search Stores Documents Delete.
 *
 * Maps to the official Gemini endpoint DELETE /v1beta/{+name}.
 */
class GeminiFileSearchStoresDocumentsDelete extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_file_search_stores_documents_delete';
    protected const DESCRIPTION = 'File Search Stores Documents Delete

Official Google Gemini endpoint: DELETE /v1beta/{+name}
Deletes a `Document`.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Gemini API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Gemini method. Known keys: force.',
  ),
  'force' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Optional. If set to true, any `Chunk`s and objects related to this `Document` will also be deleted. If false (the default), a `FAILED_PRECONDITION` error will be returned if `Document` contains any `Chunk`s.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1beta/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'force',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
