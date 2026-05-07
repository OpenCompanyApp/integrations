<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Files List.
 *
 * Maps to the official Gemini endpoint GET /v1beta/files.
 */
class GeminiFilesList extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_files_list';
    protected const DESCRIPTION = 'Files List

Official Google Gemini endpoint: GET /v1beta/files
Lists the metadata for `File`s owned by the requesting project.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Gemini method. Known keys: pageSize, pageToken.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. Maximum number of `File`s to return per page. If unspecified, defaults to 10. Maximum `page_size` is 100.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token from a previous `ListFiles` call.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1beta/files';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
