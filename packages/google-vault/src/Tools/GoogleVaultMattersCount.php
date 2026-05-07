<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Count.
 *
 * Maps to the official Google Vault endpoint POST /v1/matters/{matterId}:count.
 */
class GoogleVaultMattersCount extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_count';
    protected const DESCRIPTION = 'Matters Count

Official Google Vault endpoint: POST /v1/matters/{matterId}:count
Counts the accounts processed by the specified query.';
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
    'description' => 'JSON request body matching the official Google Vault `CountArtifactsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/matters/{matterId}:count';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
