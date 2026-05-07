<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Operations Delete.
 *
 * Maps to the official Cloud Translation endpoint DELETE /v3/{+name}.
 */
class GoogleTranslateProjectsLocationsOperationsDelete extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_operations_delete';
    protected const DESCRIPTION = 'Projects Locations Operations Delete

Official Google Cloud Translation endpoint: DELETE /v3/{+name}
Deletes a long-running operation. This method indicates that the client is no longer interested in the operation result. It does not cancel the operation. If the server doesn\'t support this method, it returns `google.rpc.Code.UNIMPLEMENTED`.';
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
