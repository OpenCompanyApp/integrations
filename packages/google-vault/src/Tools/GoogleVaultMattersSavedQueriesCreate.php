<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Saved Queries Create.
 *
 * Maps to the official Google Vault endpoint POST /v1/matters/{matterId}/savedQueries.
 */
class GoogleVaultMattersSavedQueriesCreate extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_saved_queries_create';
    protected const DESCRIPTION = 'Matters Saved Queries Create

Official Google Vault endpoint: POST /v1/matters/{matterId}/savedQueries
Creates a saved query.';
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
    'description' => 'JSON request body matching the official Google Vault `SavedQuery` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/matters/{matterId}/savedQueries';
    protected const PATH_PARAMS = array (
  0 => 'matterId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
