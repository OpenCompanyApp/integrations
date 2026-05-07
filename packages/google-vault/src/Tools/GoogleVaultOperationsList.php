<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Operations List.
 *
 * Maps to the official Google Vault endpoint GET /v1/{+name}.
 */
class GoogleVaultOperationsList extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_operations_list';
    protected const DESCRIPTION = 'Operations List

Official Google Vault endpoint: GET /v1/{+name}
Lists operations that match the specified filter in the request.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Google Vault method. Known keys: pageToken, returnPartialSuccess, pageSize, filter.',
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
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'returnPartialSuccess',
  2 => 'pageSize',
  3 => 'filter',
);
    protected const BODY_REQUIRED = false;
}
