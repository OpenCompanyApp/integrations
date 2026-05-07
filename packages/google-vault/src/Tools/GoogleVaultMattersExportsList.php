<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Exports List.
 *
 * Maps to the official Google Vault endpoint GET /v1/matters/{matterId}/exports.
 */
class GoogleVaultMattersExportsList extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_exports_list';
    protected const DESCRIPTION = 'Matters Exports List

Official Google Vault endpoint: GET /v1/matters/{matterId}/exports
Lists details about the exports in the specified matter.';
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
    'description' => 'Query string parameters accepted by the official Google Vault method. Known keys: pageSize, pageToken.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/matters/{matterId}/exports';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
