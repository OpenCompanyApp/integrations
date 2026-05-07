<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Get Vault details and metadata.
 *
 * Maps to the official 1Password Connect endpoint GET /vaults/{vaultUuid}.
 */
class OnePasswordConnectGetVaultById extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_get_vault_by_id';
    protected const DESCRIPTION = 'Get Vault details and metadata

Official 1Password Connect endpoint: GET /vaults/{vaultUuid}.';
    protected const PARAMETERS = array (
      'vault_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Vault to fetch Items from',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/vaults/{vaultUuid}';
    protected const PATH_PARAMS = array (
      'vaultUuid' => 'vault_uuid',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
