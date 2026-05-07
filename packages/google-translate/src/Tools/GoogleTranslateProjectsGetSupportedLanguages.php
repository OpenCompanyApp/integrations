<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Get Supported Languages.
 *
 * Maps to the official Cloud Translation endpoint GET /v3/{+parent}/supportedLanguages.
 */
class GoogleTranslateProjectsGetSupportedLanguages extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_get_supported_languages';
    protected const DESCRIPTION = 'Projects Get Supported Languages

Official Google Cloud Translation endpoint: GET /v3/{+parent}/supportedLanguages
Returns a list of supported languages for translation.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the official Cloud Translation API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Translation method. Known keys: model, displayLanguageCode.',
  ),
  'model' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. Get supported languages of this model. The format depends on model type: - AutoML Translation models: `projects/{project-number-or-id}/locations/{location-id}/models/{model-id}` - General (built-in) models: `projects/{project-number-or-id}/locations/{location-id}/models/general/nmt`, Returns languages supported by the specified model. If missing, we get supported languages of Google general NMT model.',
  ),
  'displayLanguageCode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. The language to use to return localized, human readable names of supported languages. If missing, then display names are not returned in a response.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v3/{+parent}/supportedLanguages';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'model',
  1 => 'displayLanguageCode',
);
    protected const BODY_REQUIRED = false;
}
