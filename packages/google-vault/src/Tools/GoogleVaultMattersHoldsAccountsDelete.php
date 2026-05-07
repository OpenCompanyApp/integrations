<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Holds Accounts Delete.
 *
 * Maps to the official Google Vault endpoint DELETE /v1/matters/{matterId}/holds/{holdId}/accounts/{accountId}.
 */
class GoogleVaultMattersHoldsAccountsDelete extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_holds_accounts_delete';
    protected const DESCRIPTION = 'Matters Holds Accounts Delete

Official Google Vault endpoint: DELETE /v1/matters/{matterId}/holds/{holdId}/accounts/{accountId}
Removes an account from a hold.';
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
  'accountId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `accountId`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/matters/{matterId}/holds/{holdId}/accounts/{accountId}';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
  1 => 'holdId',
  2 => 'accountId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
