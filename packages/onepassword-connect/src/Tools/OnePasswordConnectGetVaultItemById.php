<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Get the details of an Item.
 *
 * Maps to the official 1Password Connect endpoint GET /vaults/{vaultUuid}/items/{itemUuid}.
 */
class OnePasswordConnectGetVaultItemById extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_get_vault_item_by_id';
    protected const DESCRIPTION = 'Get the details of an Item

Official 1Password Connect endpoint: GET /vaults/{vaultUuid}/items/{itemUuid}.';
    protected const PARAMETERS = array (
      'vault_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Vault to fetch Item from',
        'required' => true,
      ),
      'item_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Item to fetch',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
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
