<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Holds Update.
 *
 * Maps to the official Google Vault endpoint PUT /v1/matters/{matterId}/holds/{holdId}.
 */
class GoogleVaultMattersHoldsUpdate extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_holds_update';
    protected const DESCRIPTION = 'Matters Holds Update

Official Google Vault endpoint: PUT /v1/matters/{matterId}/holds/{holdId}
Updates the scope (organizational unit or accounts) and query parameters of a hold.';
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
    'description' => 'JSON request body matching the official Google Vault `Hold` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/matters/{matterId}/holds/{holdId}';
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
