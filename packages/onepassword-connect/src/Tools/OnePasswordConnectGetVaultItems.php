<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Get all items for inside a Vault.
 *
 * Maps to the official 1Password Connect endpoint GET /vaults/{vaultUuid}/items.
 */
class OnePasswordConnectGetVaultItems extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_get_vault_items';
    protected const DESCRIPTION = 'Get all items for inside a Vault

Official 1Password Connect endpoint: GET /vaults/{vaultUuid}/items.';
    protected const PARAMETERS = array (
      'vault_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Vault to fetch Items from',
        'required' => true,
      ),
      'filter' => array (
        'type' => 'string',
        'description' => 'Filter the Item collection based on Item name using SCIM eq filter',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/vaults/{vaultUuid}/items';
    protected const PATH_PARAMS = array (
      'vaultUuid' => 'vault_uuid',
    );
    protected const QUERY_PARAMS = array (
      'filter' => 'filter',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
