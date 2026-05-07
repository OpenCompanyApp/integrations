<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Holds Delete.
 *
 * Maps to the official Google Vault endpoint DELETE /v1/matters/{matterId}/holds/{holdId}.
 */
class GoogleVaultMattersHoldsDelete extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_holds_delete';
    protected const DESCRIPTION = 'Matters Holds Delete

Official Google Vault endpoint: DELETE /v1/matters/{matterId}/holds/{holdId}
Removes the specified hold and releases the accounts or organizational unit covered by the hold.';
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
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/matters/{matterId}/holds/{holdId}';
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
