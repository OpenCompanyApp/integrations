<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Creates a copy of an existing board. You can also update the name, description, sharing policy, and permissions policy for the new board in the request body. Required scope boards:write Rate limiting Level 4.
 *
 * Maps to the official Miro endpoint PUT /v2/boards.
 */
class MiroCopyBoard extends AbstractMiroTool
{
    protected const NAME = 'miro_copy_board';
    protected const DESCRIPTION = 'Creates a copy of an existing board. You can also update the name, description, sharing policy, and permissions policy for the new board in the request body. Required scope boards:write Rate limiting Level 4

Official Miro endpoint: PUT /v2/boards.';
    protected const PARAMETERS = array (
      'copy_from' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board that you want to copy.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/v2/boards';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'copy_from' => 'copy_from',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
