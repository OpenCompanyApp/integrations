<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a list of pagespeed checks for an account..
 *
 * Maps to the official StatusCake endpoint GET /pagespeed.
 */
class StatusCakeListPagespeedTests extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_list_pagespeed_tests';
    protected const DESCRIPTION = 'Returns a list of pagespeed checks for an account.

Official StatusCake endpoint: GET /pagespeed.';
    protected const PARAMETERS = array (
      'page' => array (
        'type' => 'integer',
        'description' => 'Page of results',
        'required' => false,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'The number of pagespeed checks to return per page',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/pagespeed';
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
