<?php

namespace OpenCompany\Integrations\GoogleVault\Tools;

/**
 * Operations Get.
 *
 * Maps to the official Google Vault endpoint GET /v1/{+name}.
 */
class GoogleVaultOperationsGet extends AbstractGoogleVaultTool
{
    protected const NAME = 'google_vault_operations_get';
    protected const DESCRIPTION = 'Operations Get

Official Google Vault endpoint: GET /v1/{+name}
Gets the latest state of a long-running operation.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use official Google Vault identifiers such as matter IDs, hold IDs, export IDs, saved query IDs, account IDs, or long-running operation resource names.',
  ),
);
    protected const METHOD = 'GET';
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
