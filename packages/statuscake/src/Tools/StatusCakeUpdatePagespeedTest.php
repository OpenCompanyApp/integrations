<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Updates a pagespeed check with the given parameters..
 *
 * Maps to the official StatusCake endpoint PUT /pagespeed/{test_id}.
 */
class StatusCakeUpdatePagespeedTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_update_pagespeed_test';
    protected const DESCRIPTION = 'Updates a pagespeed check with the given parameters.

Official StatusCake endpoint: PUT /pagespeed/{test_id}.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'Pagespeed check ID',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Form fields matching the StatusCake API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/pagespeed/{test_id}';
    protected const PATH_PARAMS = array (
      'test_id' => 'test_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
