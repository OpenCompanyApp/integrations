<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Models Get.
 *
 * Maps to the official Cloud Translation endpoint GET /v3/{+name}.
 */
class GoogleTranslateProjectsLocationsModelsGet extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_models_get';
    protected const DESCRIPTION = 'Projects Locations Models Get

Official Google Cloud Translation endpoint: GET /v3/{+name}
Gets a model.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Cloud Translation API method.',
  ),
);
    protected const METHOD = 'GET';
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
