<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Refine Text.
 *
 * Maps to the official Cloud Translation endpoint POST /v3/{+parent}:refineText.
 */
class GoogleTranslateProjectsLocationsRefineText extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_refine_text';
    protected const DESCRIPTION = 'Projects Locations Refine Text

Official Google Cloud Translation endpoint: POST /v3/{+parent}:refineText
Refines the input translated text to improve the quality.';
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
    'description' => 'JSON request body matching the official Cloud Translation API `RefineTextRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v3/{+parent}:refineText';
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
