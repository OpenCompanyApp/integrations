<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Operations Get.
 *
 * Maps to the official Cloud Translation endpoint GET /v3/{+name}.
 */
class GoogleTranslateProjectsLocationsOperationsGet extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_operations_get';
    protected const DESCRIPTION = 'Projects Locations Operations Get

Official Google Cloud Translation endpoint: GET /v3/{+name}
Gets the latest state of a long-running operation. Clients can use this method to poll the operation result at intervals as recommended by the API service.';
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
