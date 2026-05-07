<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Corpora Delete.
 *
 * Maps to the official Gemini endpoint DELETE /v1beta/{+name}.
 */
class GeminiCorporaDelete extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_corpora_delete';
    protected const DESCRIPTION = 'Corpora Delete

Official Google Gemini endpoint: DELETE /v1beta/{+name}
Deletes a `Corpus`.';
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
    'description' => 'Optional. If set to true, any `Document`s and objects related to this `Corpus` will also be deleted. If false (the default), a `FAILED_PRECONDITION` error will be returned if `Corpus` contains any `Document`s.',
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
