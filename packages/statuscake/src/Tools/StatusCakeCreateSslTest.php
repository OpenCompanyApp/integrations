<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Creates an SSL check with the given parameters..
 *
 * Maps to the official StatusCake endpoint POST /ssl.
 */
class StatusCakeCreateSslTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_create_ssl_test';
    protected const DESCRIPTION = 'Creates an SSL check with the given parameters.

Official StatusCake endpoint: POST /ssl.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'Form fields matching the StatusCake API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/ssl';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
