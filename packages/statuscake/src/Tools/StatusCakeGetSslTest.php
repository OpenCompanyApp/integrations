<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns an SSL check with the given id..
 *
 * Maps to the official StatusCake endpoint GET /ssl/{test_id}.
 */
class StatusCakeGetSslTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_get_ssl_test';
    protected const DESCRIPTION = 'Returns an SSL check with the given id.

Official StatusCake endpoint: GET /ssl/{test_id}.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'SSL check ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/ssl/{test_id}';
    protected const PATH_PARAMS = array (
      'test_id' => 'test_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
