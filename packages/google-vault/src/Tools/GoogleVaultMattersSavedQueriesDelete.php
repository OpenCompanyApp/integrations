<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Saved Queries Delete.
 *
 * Maps to the official Google Vault endpoint DELETE /v1/matters/{matterId}/savedQueries/{savedQueryId}.
 */
class GoogleVaultMattersSavedQueriesDelete extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_saved_queries_delete';
    protected const DESCRIPTION = 'Matters Saved Queries Delete

Official Google Vault endpoint: DELETE /v1/matters/{matterId}/savedQueries/{savedQueryId}
Deletes the specified saved query.';
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
    protected const METHOD = 'DELETE';
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
