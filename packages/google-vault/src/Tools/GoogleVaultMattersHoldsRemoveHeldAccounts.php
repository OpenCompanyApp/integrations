<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Holds Remove Held Accounts.
 *
 * Maps to the official Google Vault endpoint POST /v1/matters/{matterId}/holds/{holdId}:removeHeldAccounts.
 */
class GoogleVaultMattersHoldsRemoveHeldAccounts extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_holds_remove_held_accounts';
    protected const DESCRIPTION = 'Matters Holds Remove Held Accounts

Official Google Vault endpoint: POST /v1/matters/{matterId}/holds/{holdId}:removeHeldAccounts
Removes the specified accounts from a hold.';
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
    'description' => 'JSON request body matching the official Google Vault `RemoveHeldAccountsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/matters/{matterId}/holds/{holdId}:removeHeldAccounts';
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
