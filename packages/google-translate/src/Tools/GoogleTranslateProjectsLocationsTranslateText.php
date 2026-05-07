<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Translate Text.
 *
 * Maps to the official Cloud Translation endpoint POST /v3/{+parent}:translateText.
 */
class GoogleTranslateProjectsLocationsTranslateText extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_translate_text';
    protected const DESCRIPTION = 'Projects Locations Translate Text

Official Google Cloud Translation endpoint: POST /v3/{+parent}:translateText
Translates input text and returns translated text.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the official Cloud Translation API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Translation API `TranslateTextRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v3/{+parent}:translateText';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
