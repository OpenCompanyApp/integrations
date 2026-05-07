<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Delete.
 *
 * Maps to the official Google Vault endpoint DELETE /v1/matters/{matterId}.
 */
class GoogleVaultMattersDelete extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_delete';
    protected const DESCRIPTION = 'Matters Delete

Official Google Vault endpoint: DELETE /v1/matters/{matterId}
Deletes the specified matter.';
    protected const PARAMETERS = array (
  'matterId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `matterId`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/matters/{matterId}';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
