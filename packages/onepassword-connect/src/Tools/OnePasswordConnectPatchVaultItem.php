<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Applies a modified [RFC6902 JSON Patch](https://tools.ietf.org/html/rfc6902) document to an Item or ItemField. This endpoint only supports `add`, `remove` and `replace` operations. When modifying a specific ItemField, the ItemField's ID in the `path` attribute of the operation object: `/fields/{fieldId}`.
 *
 * Maps to the official 1Password Connect endpoint PATCH /vaults/{vaultUuid}/items/{itemUuid}.
 */
class OnePasswordConnectPatchVaultItem extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_patch_vault_item';
    protected const DESCRIPTION = 'Applies a modified [RFC6902 JSON Patch](https://tools.ietf.org/html/rfc6902) document to an Item or ItemField. This endpoint only supports `add`, `remove` and `replace` operations. When modifying a specific ItemField, the ItemField\'s ID in the `path` attribute of the operation object: `/fields/{fieldId}`

Official 1Password Connect endpoint: PATCH /vaults/{vaultUuid}/items/{itemUuid}.';
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
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the 1Password Connect API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PATCH';
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
