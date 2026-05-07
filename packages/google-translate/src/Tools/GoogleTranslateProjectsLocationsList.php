<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations List.
 *
 * Maps to the official Cloud Translation endpoint GET /v3/{+name}/locations.
 */
class GoogleTranslateProjectsLocationsList extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_list';
    protected const DESCRIPTION = 'Projects Locations List

Official Google Cloud Translation endpoint: GET /v3/{+name}/locations
Lists information about the supported locations for this service. This method can be called in two ways: * **List all public locations:** Use the path `GET /v1/locations`. * **List project-visible locations:** Use the path `GET /v1/projects/{project_id}/locations`. This may include public locations as well as private or other locations specifically visible to the project.';
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
    'description' => 'Query string parameters accepted by the official Cloud Translation method. Known keys: pageSize, pageToken, filter, extraLocationTypes.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of results to return. If not set, the service selects a default.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A page token received from the `next_page_token` field in the response. Send that page token to receive the subsequent page.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A filter to narrow down results to a preferred subset. The filtering language accepts strings like `"displayName=tokyo"`, and is documented in more detail in [AIP-160](https://google.aip.dev/160).',
  ),
  'extraLocationTypes' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Optional. Do not use this field. It is unsupported and is ignored unless explicitly documented otherwise. This is primarily for internal usage.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v3/{+name}/locations';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
  2 => 'filter',
  3 => 'extraLocationTypes',
);
    protected const BODY_REQUIRED = false;
}
