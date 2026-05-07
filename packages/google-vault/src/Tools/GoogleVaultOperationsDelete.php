<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Operations Delete.
 *
 * Maps to the official Google Vault endpoint DELETE /v1/{+name}.
 */
class GoogleVaultOperationsDelete extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_operations_delete';
    protected const DESCRIPTION = 'Operations Delete

Official Google Vault endpoint: DELETE /v1/{+name}
Deletes a long-running operation.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
