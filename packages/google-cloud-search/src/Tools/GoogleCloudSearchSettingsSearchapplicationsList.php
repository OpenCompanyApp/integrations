<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Settings Searchapplications List.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/settings/searchapplications.
 */
class GoogleCloudSearchSettingsSearchapplicationsList extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_settings_searchapplications_list';
    protected const DESCRIPTION = 'Settings Searchapplications List

Official Google Cloud Search endpoint: GET /v1/settings/searchapplications
Lists all search applications.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: pageSize, pageToken, debugOptions.enableDebugging.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/settings/searchapplications';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
  2 => 'debugOptions.enableDebugging',
);
    protected const BODY_REQUIRED = false;
}
