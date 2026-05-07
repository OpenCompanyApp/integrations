<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Create a new Item.
 *
 * Maps to the official 1Password Connect endpoint POST /vaults/{vaultUuid}/items.
 */
class OnePasswordConnectCreateVaultItem extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_create_vault_item';
    protected const DESCRIPTION = 'Create a new Item

Official 1Password Connect endpoint: POST /vaults/{vaultUuid}/items.';
    protected const PARAMETERS = array (
      'vault_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Vault to create an Item in',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the 1Password Connect API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/vaults/{vaultUuid}/items';
    protected const PATH_PARAMS = array (
      'vaultUuid' => 'vault_uuid',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
