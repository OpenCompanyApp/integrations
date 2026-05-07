<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Models Predict Long Running.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+model}:predictLongRunning.
 */
class GeminiModelsPredictLongRunning extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_models_predict_long_running';
    protected const DESCRIPTION = 'Models Predict Long Running

Official Google Gemini endpoint: POST /v1beta/{+model}:predictLongRunning
Same as Predict but returns an LRO.';
    protected const PARAMETERS = array (
  'model' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `model` from the official Gemini API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `PredictLongRunningRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+model}:predictLongRunning';
    protected const PATH_PARAMS = array (
  0 => 'model',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'model',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
