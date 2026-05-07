<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Holds Create.
 *
 * Maps to the official Google Vault endpoint POST /v1/matters/{matterId}/holds.
 */
class GoogleVaultMattersHoldsCreate extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_holds_create';
    protected const DESCRIPTION = 'Matters Holds Create

Official Google Vault endpoint: POST /v1/matters/{matterId}/holds
Creates a hold in the specified matter.';
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
    'required' => true,
    'description' => 'JSON request body matching the official Google Vault `Hold` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/matters/{matterId}/holds';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
