<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Operations Lro List.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/{+name}/lro.
 */
class GoogleCloudSearchOperationsLroList extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_operations_lro_list';
    protected const DESCRIPTION = 'Operations Lro List

Official Google Cloud Search endpoint: GET /v1/{+name}/lro
Lists operations that match the specified filter in the request.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Google Cloud Search resource names such as `datasources/source`, `datasources/source/items/item`, `searchapplications/app`, or long-running operation names.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: pageSize, pageToken, returnPartialSuccess, filter.',
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
  'returnPartialSuccess' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `returnPartialSuccess`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+name}/lro';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
  2 => 'returnPartialSuccess',
  3 => 'filter',
);
    protected const BODY_REQUIRED = false;
}
