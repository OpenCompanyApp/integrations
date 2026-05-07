<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Deletes a pagespeed check with the given id..
 *
 * Maps to the official StatusCake endpoint DELETE /pagespeed/{test_id}.
 */
class StatusCakeDeletePagespeedTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_delete_pagespeed_test';
    protected const DESCRIPTION = 'Deletes a pagespeed check with the given id.

Official StatusCake endpoint: DELETE /pagespeed/{test_id}.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'Pagespeed check ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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
