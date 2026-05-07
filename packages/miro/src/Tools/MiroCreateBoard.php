<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Creates a board with the specified name and sharing policies. Note You can only create up to 3 team boards with the free plan. Required scope boards:write Rate limiting Level 3.
 *
 * Maps to the official Miro endpoint POST /v2/boards.
 */
class MiroCreateBoard extends AbstractMiroTool
{
    protected const NAME = 'miro_create_board';
    protected const DESCRIPTION = 'Creates a board with the specified name and sharing policies. Note You can only create up to 3 team boards with the free plan. Required scope boards:write Rate limiting Level 3

Official Miro endpoint: POST /v2/boards.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/boards';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
