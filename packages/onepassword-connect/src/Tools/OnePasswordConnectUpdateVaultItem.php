<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Update an Item.
 *
 * Maps to the official 1Password Connect endpoint PUT /vaults/{vaultUuid}/items/{itemUuid}.
 */
class OnePasswordConnectUpdateVaultItem extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_update_vault_item';
    protected const DESCRIPTION = 'Update an Item

Official 1Password Connect endpoint: PUT /vaults/{vaultUuid}/items/{itemUuid}.';
    protected const PARAMETERS = array (
      'vault_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Item\'s Vault',
        'required' => true,
      ),
      'item_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Item to update',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the 1Password Connect API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/vaults/{vaultUuid}/items/{itemUuid}';
    protected const PATH_PARAMS = array (
      'vaultUuid' => 'vault_uuid',
      'itemUuid' => 'item_uuid',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
