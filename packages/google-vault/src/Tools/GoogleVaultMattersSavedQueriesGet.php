<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Saved Queries Get.
 *
 * Maps to the official Google Vault endpoint GET /v1/matters/{matterId}/savedQueries/{savedQueryId}.
 */
class GoogleVaultMattersSavedQueriesGet extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_saved_queries_get';
    protected const DESCRIPTION = 'Matters Saved Queries Get

Official Google Vault endpoint: GET /v1/matters/{matterId}/savedQueries/{savedQueryId}
Retrieves the specified saved query.';
    protected const PARAMETERS = array (
  'matterId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `matterId`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
  'savedQueryId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `savedQueryId`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/matters/{matterId}/savedQueries/{savedQueryId}';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
  1 => 'savedQueryId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
