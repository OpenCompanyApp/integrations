<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Close.
 *
 * Maps to the official Google Vault endpoint POST /v1/matters/{matterId}:close.
 */
class GoogleVaultMattersClose extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_close';
    protected const DESCRIPTION = 'Matters Close

Official Google Vault endpoint: POST /v1/matters/{matterId}:close
Closes the specified matter.';
    protected const PARAMETERS = array (
  'matterId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `matterId`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Google Vault `CloseMatterRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/matters/{matterId}:close';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
