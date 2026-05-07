<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Exports Create.
 *
 * Maps to the official Google Vault endpoint POST /v1/matters/{matterId}/exports.
 */
class GoogleVaultMattersExportsCreate extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_exports_create';
    protected const DESCRIPTION = 'Matters Exports Create

Official Google Vault endpoint: POST /v1/matters/{matterId}/exports
Creates an export.';
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
    'description' => 'JSON request body matching the official Google Vault `Export` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/matters/{matterId}/exports';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
