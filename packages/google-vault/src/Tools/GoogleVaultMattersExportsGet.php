<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Exports Get.
 *
 * Maps to the official Google Vault endpoint GET /v1/matters/{matterId}/exports/{exportId}.
 */
class GoogleVaultMattersExportsGet extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_exports_get';
    protected const DESCRIPTION = 'Matters Exports Get

Official Google Vault endpoint: GET /v1/matters/{matterId}/exports/{exportId}
Gets an export.';
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
    protected const METHOD = 'GET';
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
