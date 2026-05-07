<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Tuned Models Create.
 *
 * Maps to the official Gemini endpoint POST /v1beta/tunedModels.
 */
class GeminiTunedModelsCreate extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_tuned_models_create';
    protected const DESCRIPTION = 'Tuned Models Create

Official Google Gemini endpoint: POST /v1beta/tunedModels
Creates a tuned model. Check intermediate tuning progress (if any) through the [google.longrunning.Operations] service. Access status and results through the Operations service. Example: GET /v1/tunedModels/az2mb0bpw6i/operations/000-111-222';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Gemini method. Known keys: tunedModelId.',
  ),
  'tunedModelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. The unique id for the tuned model if specified. This value should be up to 40 characters, the first character must be a letter, the last could be a letter or a number. The id must match the regular expression: `[a-z]([a-z0-9-]{0,38}[a-z0-9])?`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `TunedModel` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/tunedModels';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'tunedModelId',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
