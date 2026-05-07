<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Generated Files List.
 *
 * Maps to the official Gemini endpoint GET /v1beta/generatedFiles.
 */
class GeminiGeneratedFilesList extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_generated_files_list';
    protected const DESCRIPTION = 'Generated Files List

Official Google Gemini endpoint: GET /v1beta/generatedFiles
Lists the generated files owned by the requesting project.';
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
    'description' => 'Optional. Maximum number of `GeneratedFile`s to return per page. If unspecified, defaults to 10. Maximum `page_size` is 50.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token from a previous `ListGeneratedFiles` call.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1beta/generatedFiles';
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
