<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Get the details of a File.
 *
 * Maps to the official 1Password Connect endpoint GET /vaults/{vaultUuid}/items/{itemUuid}/files/{fileUuid}.
 */
class OnePasswordConnectGetDetailsOfFileById extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_get_details_of_file_by_id';
    protected const DESCRIPTION = 'Get the details of a File

Official 1Password Connect endpoint: GET /vaults/{vaultUuid}/items/{itemUuid}/files/{fileUuid}.';
    protected const PARAMETERS = array (
      'vault_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Vault to fetch Item from',
        'required' => true,
      ),
      'item_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the Item to fetch File from',
        'required' => true,
      ),
      'file_uuid' => array (
        'type' => 'string',
        'description' => 'The UUID of the File to fetch',
        'required' => true,
      ),
      'inline_files' => array (
        'type' => 'boolean',
        'description' => 'Tells server to return the base64-encoded file contents in the response.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/vaults/{vaultUuid}/items/{itemUuid}/files/{fileUuid}';
    protected const PATH_PARAMS = array (
      'vaultUuid' => 'vault_uuid',
      'itemUuid' => 'item_uuid',
      'fileUuid' => 'file_uuid',
    );
    protected const QUERY_PARAMS = array (
      'inline_files' => 'inline_files',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
