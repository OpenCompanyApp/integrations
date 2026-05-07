<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Tuned Models Delete.
 *
 * Maps to the official Gemini endpoint DELETE /v1beta/{+name}.
 */
class GeminiTunedModelsDelete extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_tuned_models_delete';
    protected const DESCRIPTION = 'Tuned Models Delete

Official Google Gemini endpoint: DELETE /v1beta/{+name}
Deletes a tuned model.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Gemini API method.',
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
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
