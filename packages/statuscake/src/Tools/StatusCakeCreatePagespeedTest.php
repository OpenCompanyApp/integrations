<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Creates a pagespeed check with the given parameters..
 *
 * Maps to the official StatusCake endpoint POST /pagespeed.
 */
class StatusCakeCreatePagespeedTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_create_pagespeed_test';
    protected const DESCRIPTION = 'Creates a pagespeed check with the given parameters.

Official StatusCake endpoint: POST /pagespeed.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'Form fields matching the StatusCake API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/pagespeed';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
