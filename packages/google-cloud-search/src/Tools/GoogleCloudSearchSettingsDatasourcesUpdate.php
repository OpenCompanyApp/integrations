<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Settings Datasources Update.
 *
 * Maps to the official Google Cloud Search endpoint PUT /v1/settings/{+name}.
 */
class GoogleCloudSearchSettingsDatasourcesUpdate extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_settings_datasources_update';
    protected const DESCRIPTION = 'Settings Datasources Update

Official Google Cloud Search endpoint: PUT /v1/settings/{+name}
Updates a datasource.';
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
    'description' => 'JSON request body matching the official Google Cloud Search `UpdateDataSourceRequest` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/settings/{+name}';
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
