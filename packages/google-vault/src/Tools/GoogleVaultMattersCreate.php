<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Matters Create.
 *
 * Maps to the official Google Vault endpoint POST /v1/matters.
 */
class GoogleVaultMattersCreate extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_matters_create';
    protected const DESCRIPTION = 'Matters Create

Official Google Vault endpoint: POST /v1/matters
Creates a matter with the given name and description.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Vault `Matter` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/matters';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
