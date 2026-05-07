<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Holds Accounts List.
 *
 * Maps to the official Google Vault endpoint GET /v1/matters/{matterId}/holds/{holdId}/accounts.
 */
class GoogleVaultMattersHoldsAccountsList extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_holds_accounts_list';
    protected const DESCRIPTION = 'Matters Holds Accounts List

Official Google Vault endpoint: GET /v1/matters/{matterId}/holds/{holdId}/accounts
Lists the accounts covered by a hold.';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/matters/{matterId}/holds/{holdId}/accounts';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
  1 => 'holdId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
