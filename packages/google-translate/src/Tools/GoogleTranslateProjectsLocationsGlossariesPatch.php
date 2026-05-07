<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Glossaries Patch.
 *
 * Maps to the official Cloud Translation endpoint PATCH /v3/{+name}.
 */
class GoogleTranslateProjectsLocationsGlossariesPatch extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_glossaries_patch';
    protected const DESCRIPTION = 'Projects Locations Glossaries Patch

Official Google Cloud Translation endpoint: PATCH /v3/{+name}
Updates a glossary. A LRO is used since the update can be async if the glossary\'s entry file is updated.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Cloud Translation API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Translation method. Known keys: updateMask.',
  ),
  'updateMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The list of fields to be updated. Currently, only `display_name` and `input_config` are supported.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Translation API `Glossary` schema.',
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
  0 => 'updateMask',
);
    protected const BODY_REQUIRED = true;
}
