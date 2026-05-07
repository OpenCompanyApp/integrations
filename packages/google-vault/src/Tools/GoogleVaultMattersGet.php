<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Get.
 *
 * Maps to the official Google Vault endpoint GET /v1/matters/{matterId}.
 */
class GoogleVaultMattersGet extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_get';
    protected const DESCRIPTION = 'Matters Get

Official Google Vault endpoint: GET /v1/matters/{matterId}
Gets the specified matter.';
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
    'description' => 'Query string parameters accepted by the official Google Vault method. Known keys: view.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/matters/{matterId}';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'view',
);
    protected const BODY_REQUIRED = false;
}
