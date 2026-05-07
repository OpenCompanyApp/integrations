<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Debug Identitysources Items List Forunmappedidentity.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/debug/{+parent}/items:forunmappedidentity.
 */
class GoogleCloudSearchDebugIdentitysourcesItemsListForunmappedidentity extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_debug_identitysources_items_list_forunmappedidentity';
    protected const DESCRIPTION = 'Debug Identitysources Items List Forunmappedidentity

Official Google Cloud Search endpoint: GET /v1/debug/{+parent}/items:forunmappedidentity
Lists names of items associated with an unmapped identity.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Google Cloud Search resource names such as `datasources/source`, `datasources/source/items/item`, `searchapplications/app`, or long-running operation names.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: pageSize, pageToken, debugOptions.enableDebugging, groupResourceName, userResourceName.',
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
  'groupResourceName' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `groupResourceName`.',
  ),
  'userResourceName' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userResourceName`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/debug/{+parent}/items:forunmappedidentity';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
  2 => 'debugOptions.enableDebugging',
  3 => 'groupResourceName',
  4 => 'userResourceName',
);
    protected const BODY_REQUIRED = false;
}
