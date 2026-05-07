<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Glossaries Glossary Entries Patch.
 *
 * Maps to the official Cloud Translation endpoint PATCH /v3/{+name}.
 */
class GoogleTranslateProjectsLocationsGlossariesGlossaryEntriesPatch extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_glossaries_glossary_entries_patch';
    protected const DESCRIPTION = 'Projects Locations Glossaries Glossary Entries Patch

Official Google Cloud Translation endpoint: PATCH /v3/{+name}
Updates a glossary entry.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Cloud Translation API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Translation API `GlossaryEntry` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v3/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
