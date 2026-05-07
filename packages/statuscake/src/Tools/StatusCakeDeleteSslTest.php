<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Deletes an SSL check with the given id..
 *
 * Maps to the official StatusCake endpoint DELETE /ssl/{test_id}.
 */
class StatusCakeDeleteSslTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_delete_ssl_test';
    protected const DESCRIPTION = 'Deletes an SSL check with the given id.

Official StatusCake endpoint: DELETE /ssl/{test_id}.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'Pagespeed check ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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
