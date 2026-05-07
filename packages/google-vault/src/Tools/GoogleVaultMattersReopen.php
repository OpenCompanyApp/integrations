<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Reopen.
 *
 * Maps to the official Google Vault endpoint POST /v1/matters/{matterId}:reopen.
 */
class GoogleVaultMattersReopen extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_reopen';
    protected const DESCRIPTION = 'Matters Reopen

Official Google Vault endpoint: POST /v1/matters/{matterId}:reopen
Reopens the specified matter.';
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
    'description' => 'JSON request body matching the official Google Vault `ReopenMatterRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/matters/{matterId}:reopen';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
