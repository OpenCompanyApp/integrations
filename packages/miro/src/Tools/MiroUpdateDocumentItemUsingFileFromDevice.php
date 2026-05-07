<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates a document item on a board by using file from a device. Required scope boards:write Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint PATCH /v2/boards/{board_id_PlatformFileUpload}/documents/{item_id}.
 */
class MiroUpdateDocumentItemUsingFileFromDevice extends AbstractMiroTool
{
    protected const NAME = 'miro_update_document_item_using_file_from_device';
    protected const DESCRIPTION = 'Updates a document item on a board by using file from a device. Required scope boards:write Rate limiting Level 2

Official Miro endpoint: PATCH /v2/boards/{board_id_PlatformFileUpload}/documents/{item_id}.';
    protected const PARAMETERS = array (
      'board_id_platform_file_upload' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board where you want to update the item.',
        'required' => true,
      ),
      'item_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the item that you want to update.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/boards/{board_id_PlatformFileUpload}/documents/{item_id}';
    protected const PATH_PARAMS = array (
      'board_id_PlatformFileUpload' => 'board_id_platform_file_upload',
      'item_id' => 'item_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'multipart/form-data';
}
