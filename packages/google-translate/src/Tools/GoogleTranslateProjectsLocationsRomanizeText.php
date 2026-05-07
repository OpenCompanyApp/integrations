<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Romanize Text.
 *
 * Maps to the official Cloud Translation endpoint POST /v3/{+parent}:romanizeText.
 */
class GoogleTranslateProjectsLocationsRomanizeText extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_romanize_text';
    protected const DESCRIPTION = 'Projects Locations Romanize Text

Official Google Cloud Translation endpoint: POST /v3/{+parent}:romanizeText
Romanize input text written in non-Latin scripts to Latin text.';
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
    'description' => 'JSON request body matching the official Cloud Translation API `RomanizeTextRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v3/{+parent}:romanizeText';
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
