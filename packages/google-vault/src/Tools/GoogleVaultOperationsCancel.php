<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Operations Cancel.
 *
 * Maps to the official Google Vault endpoint POST /v1/{+name}:cancel.
 */
class GoogleVaultOperationsCancel extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_operations_cancel';
    protected const DESCRIPTION = 'Operations Cancel

Official Google Vault endpoint: POST /v1/{+name}:cancel
Starts asynchronous cancellation on a long-running operation.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Google Vault `CancelOperationRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:cancel';
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
