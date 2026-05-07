<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Adds a document item to a board by selecting file from device. Required scope boards:write Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint POST /v2/boards/{board_id_PlatformFileUpload}/documents.
 */
class MiroCreateDocumentItemUsingFileFromDevice extends AbstractMiroTool
{
    protected const NAME = 'miro_create_document_item_using_file_from_device';
    protected const DESCRIPTION = 'Adds a document item to a board by selecting file from device. Required scope boards:write Rate limiting Level 2

Official Miro endpoint: POST /v2/boards/{board_id_PlatformFileUpload}/documents.';
    protected const PARAMETERS = array (
      'board_id_platform_file_upload' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board where you want to create the item.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/boards/{board_id_PlatformFileUpload}/documents';
    protected const PATH_PARAMS = array (
      'board_id_PlatformFileUpload' => 'board_id_platform_file_upload',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'multipart/form-data';
}
