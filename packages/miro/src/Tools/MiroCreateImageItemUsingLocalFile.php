<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Adds an image item to a board by specifying a file from device. Required scope boards:write Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint POST /v2/boards/{board_id_PlatformFileUpload}/images.
 */
class MiroCreateImageItemUsingLocalFile extends AbstractMiroTool
{
    protected const NAME = 'miro_create_image_item_using_local_file';
    protected const DESCRIPTION = 'Adds an image item to a board by specifying a file from device. Required scope boards:write Rate limiting Level 2

Official Miro endpoint: POST /v2/boards/{board_id_PlatformFileUpload}/images.';
    protected const PARAMETERS = array (
      'board_id_platform_file_upload' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board where you want to create the item.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/boards/{board_id_PlatformFileUpload}/images';
    protected const PATH_PARAMS = array (
      'board_id_PlatformFileUpload' => 'board_id_platform_file_upload',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'multipart/form-data';
}
