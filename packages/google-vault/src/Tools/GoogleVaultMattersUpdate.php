<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Update.
 *
 * Maps to the official Google Vault endpoint PUT /v1/matters/{matterId}.
 */
class GoogleVaultMattersUpdate extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_update';
    protected const DESCRIPTION = 'Matters Update

Official Google Vault endpoint: PUT /v1/matters/{matterId}
Updates the specified matter.';
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
    'description' => 'JSON request body matching the official Google Vault `Matter` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/matters/{matterId}';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
