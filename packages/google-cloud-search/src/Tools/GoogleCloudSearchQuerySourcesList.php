<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Query Sources List.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/query/sources.
 */
class GoogleCloudSearchQuerySourcesList extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_query_sources_list';
    protected const DESCRIPTION = 'Query Sources List

Official Google Cloud Search endpoint: GET /v1/query/sources
Returns list of sources that user can use for Search and Suggest APIs.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: requestOptions.clientDisplayLanguageCode, requestOptions.searchApplicationId, requestOptions.debugOptions.enableDebugging, requestOptions.timeZone, requestOptions.languageCode, pageToken.',
  ),
  'requestOptions.clientDisplayLanguageCode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `requestOptions.clientDisplayLanguageCode`.',
  ),
  'requestOptions.searchApplicationId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `requestOptions.searchApplicationId`.',
  ),
  'requestOptions.debugOptions.enableDebugging' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `requestOptions.debugOptions.enableDebugging`.',
  ),
  'requestOptions.timeZone' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `requestOptions.timeZone`.',
  ),
  'requestOptions.languageCode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `requestOptions.languageCode`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/query/sources';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'requestOptions.clientDisplayLanguageCode',
  1 => 'requestOptions.searchApplicationId',
  2 => 'requestOptions.debugOptions.enableDebugging',
  3 => 'requestOptions.timeZone',
  4 => 'requestOptions.languageCode',
  5 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
