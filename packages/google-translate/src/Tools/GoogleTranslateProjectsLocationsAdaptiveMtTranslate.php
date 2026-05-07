<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Adaptive Mt Translate.
 *
 * Maps to the official Cloud Translation endpoint POST /v3/{+parent}:adaptiveMtTranslate.
 */
class GoogleTranslateProjectsLocationsAdaptiveMtTranslate extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_adaptive_mt_translate';
    protected const DESCRIPTION = 'Projects Locations Adaptive Mt Translate

Official Google Cloud Translation endpoint: POST /v3/{+parent}:adaptiveMtTranslate
Translate text using Adaptive MT.';
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
    'description' => 'JSON request body matching the official Cloud Translation API `AdaptiveMtTranslateRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v3/{+parent}:adaptiveMtTranslate';
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
