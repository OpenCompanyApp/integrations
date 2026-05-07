<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a pagespeed check with the given id..
 *
 * Maps to the official StatusCake endpoint GET /pagespeed/{test_id}.
 */
class StatusCakeGetPagespeedTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_get_pagespeed_test';
    protected const DESCRIPTION = 'Returns a pagespeed check with the given id.

Official StatusCake endpoint: GET /pagespeed/{test_id}.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'Pagespeed check ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/pagespeed/{test_id}';
    protected const PATH_PARAMS = array (
      'test_id' => 'test_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
