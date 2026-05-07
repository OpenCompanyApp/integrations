<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Settings Searchapplications Reset.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/settings/{+name}:reset.
 */
class GoogleCloudSearchSettingsSearchapplicationsReset extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_settings_searchapplications_reset';
    protected const DESCRIPTION = 'Settings Searchapplications Reset

Official Google Cloud Search endpoint: POST /v1/settings/{+name}:reset
Resets a search application to default settings.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Google Cloud Search resource names such as `datasources/source`, `datasources/source/items/item`, `searchapplications/app`, or long-running operation names.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Cloud Search `ResetSearchApplicationRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/settings/{+name}:reset';
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
