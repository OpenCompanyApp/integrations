<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Holds List.
 *
 * Maps to the official Google Vault endpoint GET /v1/matters/{matterId}/holds.
 */
class GoogleVaultMattersHoldsList extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_holds_list';
    protected const DESCRIPTION = 'Matters Holds List

Official Google Vault endpoint: GET /v1/matters/{matterId}/holds
Lists the holds in a matter.';
    protected const PARAMETERS = array (
  'matterId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `matterId`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Google Vault method. Known keys: pageToken, view, pageSize.',
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
      0 => 'HOLD_VIEW_UNSPECIFIED',
      1 => 'BASIC_HOLD',
      2 => 'FULL_HOLD',
    ),
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/matters/{matterId}/holds';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'view',
  2 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
