<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Debug Identitysources Unmappedids List.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/debug/{+parent}/unmappedids.
 */
class GoogleCloudSearchDebugIdentitysourcesUnmappedidsList extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_debug_identitysources_unmappedids_list';
    protected const DESCRIPTION = 'Debug Identitysources Unmappedids List

Official Google Cloud Search endpoint: GET /v1/debug/{+parent}/unmappedids
Lists unmapped user identities for an identity source.';
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
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: pageToken, debugOptions.enableDebugging, pageSize, resolutionStatusCode.',
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
  'resolutionStatusCode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `resolutionStatusCode`.',
    'enum' =>
    array (
      0 => 'CODE_UNSPECIFIED',
      1 => 'NOT_FOUND',
      2 => 'IDENTITY_SOURCE_NOT_FOUND',
      3 => 'IDENTITY_SOURCE_MISCONFIGURED',
      4 => 'TOO_MANY_MAPPINGS_FOUND',
      5 => 'INTERNAL_ERROR',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/debug/{+parent}/unmappedids';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'debugOptions.enableDebugging',
  2 => 'pageSize',
  3 => 'resolutionStatusCode',
);
    protected const BODY_REQUIRED = false;
}
