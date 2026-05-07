<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Models Create.
 *
 * Maps to the official Cloud Translation endpoint POST /v3/{+parent}/models.
 */
class GoogleTranslateProjectsLocationsModelsCreate extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_models_create';
    protected const DESCRIPTION = 'Projects Locations Models Create

Official Google Cloud Translation endpoint: POST /v3/{+parent}/models
Creates a Model.';
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
    'description' => 'JSON request body matching the official Cloud Translation API `Model` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v3/{+parent}/models';
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
