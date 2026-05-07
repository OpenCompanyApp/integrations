<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a list of SSL checks for an account..
 *
 * Maps to the official StatusCake endpoint GET /ssl.
 */
class StatusCakeListSslTests extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_list_ssl_tests';
    protected const DESCRIPTION = 'Returns a list of SSL checks for an account.

Official StatusCake endpoint: GET /ssl.';
    protected const PARAMETERS = array (
      'page' => array (
        'type' => 'integer',
        'description' => 'Page of results',
        'required' => false,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'The number of SSL checks to return per page',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/ssl';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'page' => 'page',
      'limit' => 'limit',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
