<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Delete an Item.
 *
 * Maps to the official 1Password Connect endpoint DELETE /vaults/{vaultUuid}/items/{itemUuid}.
 */
class OnePasswordConnectDeleteVaultItem extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_delete_vault_item';
    protected const DESCRIPTION = 'Delete an Item

Official 1Password Connect endpoint: DELETE /vaults/{vaultUuid}/items/{itemUuid}.';
    protected const PARAMETERS = array (
      'vault_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Vault the item is in',
        'required' => true,
      ),
      'item_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Item to update',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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
