<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Tuned Models Patch.
 *
 * Maps to the official Gemini endpoint PATCH /v1beta/{+name}.
 */
class GeminiTunedModelsPatch extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_tuned_models_patch';
    protected const DESCRIPTION = 'Tuned Models Patch

Official Google Gemini endpoint: PATCH /v1beta/{+name}
Updates a tuned model.';
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
    'description' => 'Query string parameters accepted by the official Gemini method. Known keys: updateMask.',
  ),
  'updateMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. The list of fields to update.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `TunedModel` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1beta/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'updateMask',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
