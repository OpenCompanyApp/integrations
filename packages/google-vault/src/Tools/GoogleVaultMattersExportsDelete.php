<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Exports Delete.
 *
 * Maps to the official Google Vault endpoint DELETE /v1/matters/{matterId}/exports/{exportId}.
 */
class GoogleVaultMattersExportsDelete extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_exports_delete';
    protected const DESCRIPTION = 'Matters Exports Delete

Official Google Vault endpoint: DELETE /v1/matters/{matterId}/exports/{exportId}
Deletes an export.';
    protected const PARAMETERS = array (
  'matterId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `matterId`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
  'exportId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `exportId`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/matters/{matterId}/exports/{exportId}';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
  1 => 'exportId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
