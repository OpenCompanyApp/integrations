<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Detect Language.
 *
 * Maps to the official Cloud Translation endpoint POST /v3/{+parent}:detectLanguage.
 */
class GoogleTranslateProjectsLocationsDetectLanguage extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_detect_language';
    protected const DESCRIPTION = 'Projects Locations Detect Language

Official Google Cloud Translation endpoint: POST /v3/{+parent}:detectLanguage
Detects the language of text within a request.';
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
    'description' => 'JSON request body matching the official Cloud Translation API `DetectLanguageRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v3/{+parent}:detectLanguage';
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
