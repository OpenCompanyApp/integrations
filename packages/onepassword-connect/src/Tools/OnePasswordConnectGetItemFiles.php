<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Get all the files inside an Item.
 *
 * Maps to the official 1Password Connect endpoint GET /vaults/{vaultUuid}/items/{itemUuid}/files.
 */
class OnePasswordConnectGetItemFiles extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_get_item_files';
    protected const DESCRIPTION = 'Get all the files inside an Item

Official 1Password Connect endpoint: GET /vaults/{vaultUuid}/items/{itemUuid}/files.';
    protected const PARAMETERS = array (
      'vault_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Vault to fetch Items from',
        'required' => true,
      ),
      'item_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Item to fetch files from',
        'required' => true,
      ),
      'inline_files' => array (
        'type' => 'boolean',
        'description' => 'Tells server to return the base64-encoded file contents in the response.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/vaults/{vaultUuid}/items/{itemUuid}/files';
    protected const PATH_PARAMS = array (
      'vaultUuid' => 'vault_uuid',
      'itemUuid' => 'item_uuid',
    );
    protected const QUERY_PARAMS = array (
      'inline_files' => 'inline_files',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
