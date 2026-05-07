<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Holds Accounts Create.
 *
 * Maps to the official Google Vault endpoint POST /v1/matters/{matterId}/holds/{holdId}/accounts.
 */
class GoogleVaultMattersHoldsAccountsCreate extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_holds_accounts_create';
    protected const DESCRIPTION = 'Matters Holds Accounts Create

Official Google Vault endpoint: POST /v1/matters/{matterId}/holds/{holdId}/accounts
Adds an account to a hold.';
    protected const PARAMETERS = array (
  'matterId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `matterId`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
  'holdId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `holdId`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Vault `HeldAccount` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/matters/{matterId}/holds/{holdId}/accounts';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
  1 => 'holdId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
