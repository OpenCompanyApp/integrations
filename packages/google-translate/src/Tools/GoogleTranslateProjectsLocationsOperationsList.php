<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Operations List.
 *
 * Maps to the official Cloud Translation endpoint GET /v3/{+name}/operations.
 */
class GoogleTranslateProjectsLocationsOperationsList extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_operations_list';
    protected const DESCRIPTION = 'Projects Locations Operations List

Official Google Cloud Translation endpoint: GET /v3/{+name}/operations
Lists operations that match the specified filter in the request. If the server doesn\'t support this method, it returns `UNIMPLEMENTED`.';
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
    'description' => 'Query string parameters accepted by the official Cloud Translation method. Known keys: filter, returnPartialSuccess, pageToken, pageSize.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The standard list filter.',
  ),
  'returnPartialSuccess' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'When set to `true`, operations that are reachable are returned as normal, and those that are unreachable are returned in the ListOperationsResponse.unreachable field. This can only be `true` when reading across collections. For example, when `parent` is set to `"projects/example/locations/-"`. This field is not supported by default and will result in an `UNIMPLEMENTED` error if set unless explicitly documented otherwise in service or product specific documentation.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The standard list page token.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The standard list page size.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v3/{+name}/operations';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'filter',
  1 => 'returnPartialSuccess',
  2 => 'pageToken',
  3 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
