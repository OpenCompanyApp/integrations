<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Settings Datasources List.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/settings/datasources.
 */
class GoogleCloudSearchSettingsDatasourcesList extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_settings_datasources_list';
    protected const DESCRIPTION = 'Settings Datasources List

Official Google Cloud Search endpoint: GET /v1/settings/datasources
Lists datasources.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: pageToken, debugOptions.enableDebugging, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'debugOptions.enableDebugging' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `debugOptions.enableDebugging`.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/settings/datasources';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'debugOptions.enableDebugging',
  2 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
