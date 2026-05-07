<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Glossaries Create.
 *
 * Maps to the official Cloud Translation endpoint POST /v3/{+parent}/glossaries.
 */
class GoogleTranslateProjectsLocationsGlossariesCreate extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_glossaries_create';
    protected const DESCRIPTION = 'Projects Locations Glossaries Create

Official Google Cloud Translation endpoint: POST /v3/{+parent}/glossaries
Creates a glossary and returns the long-running operation. Returns NOT_FOUND, if the project doesn\'t exist.';
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
    'description' => 'JSON request body matching the official Cloud Translation API `Glossary` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v3/{+parent}/glossaries';
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
