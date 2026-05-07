<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Glossaries Delete.
 *
 * Maps to the official Cloud Translation endpoint DELETE /v3/{+name}.
 */
class GoogleTranslateProjectsLocationsGlossariesDelete extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_glossaries_delete';
    protected const DESCRIPTION = 'Projects Locations Glossaries Delete

Official Google Cloud Translation endpoint: DELETE /v3/{+name}
Deletes a glossary, or cancels glossary construction if the glossary isn\'t created yet. Returns NOT_FOUND, if the glossary doesn\'t exist.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Cloud Translation API method.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
