<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Updates an SSL check with the given parameters..
 *
 * Maps to the official StatusCake endpoint PUT /ssl/{test_id}.
 */
class StatusCakeUpdateSslTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_update_ssl_test';
    protected const DESCRIPTION = 'Updates an SSL check with the given parameters.

Official StatusCake endpoint: PUT /ssl/{test_id}.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'SSL check ID',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Form fields matching the StatusCake API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/ssl/{test_id}';
    protected const PATH_PARAMS = array (
      'test_id' => 'test_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
