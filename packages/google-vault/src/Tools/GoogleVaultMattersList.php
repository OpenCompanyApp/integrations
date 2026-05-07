<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters List.
 *
 * Maps to the official Google Vault endpoint GET /v1/matters.
 */
class GoogleVaultMattersList extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_list';
    protected const DESCRIPTION = 'Matters List

Official Google Vault endpoint: GET /v1/matters
Lists matters the requestor has access to.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Google Vault method. Known keys: pageSize, pageToken, view, state.',
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
  'view' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `view`.',
    'enum' =>
    array (
      0 => 'VIEW_UNSPECIFIED',
      1 => 'BASIC',
      2 => 'FULL',
    ),
  ),
  'state' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `state`.',
    'enum' =>
    array (
      0 => 'STATE_UNSPECIFIED',
      1 => 'OPEN',
      2 => 'CLOSED',
      3 => 'DELETED',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/matters';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
  2 => 'view',
  3 => 'state',
);
    protected const BODY_REQUIRED = false;
}
