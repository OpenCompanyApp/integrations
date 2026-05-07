<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Get the content of a File.
 *
 * Maps to the official 1Password Connect endpoint GET /vaults/{vaultUuid}/items/{itemUuid}/files/{fileUuid}/content.
 */
class OnePasswordConnectDownloadFileById extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_download_file_by_id';
    protected const DESCRIPTION = 'Get the content of a File

Official 1Password Connect endpoint: GET /vaults/{vaultUuid}/items/{itemUuid}/files/{fileUuid}/content.';
    protected const PARAMETERS = array (
      'vault_uuid' => array (
        'type' => 'string',
        'description' => 'vaultUuid path parameter.',
        'required' => true,
      ),
      'item_uuid' => array (
        'type' => 'string',
        'description' => 'itemUuid path parameter.',
        'required' => true,
      ),
      'file_uuid' => array (
        'type' => 'string',
        'description' => 'fileUuid path parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/vaults/{vaultUuid}/items/{itemUuid}/files/{fileUuid}/content';
    protected const PATH_PARAMS = array (
      'vaultUuid' => 'vault_uuid',
      'itemUuid' => 'item_uuid',
      'fileUuid' => 'file_uuid',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
