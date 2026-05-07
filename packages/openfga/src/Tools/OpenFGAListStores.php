<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * Returns a paginated list of OpenFGA stores and a continuation token to get additional stores. The continuation token will be empty if there are no more stores..
 *
 * Maps to the official OpenFGA endpoint GET /stores.
 */
class OpenFGAListStores extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_list_stores';
    protected const DESCRIPTION = 'Returns a paginated list of OpenFGA stores and a continuation token to get additional stores. The continuation token will be empty if there are no more stores.

Official OpenFGA endpoint: GET /stores.';
    protected const PARAMETERS = array (
      'page_size' => array (
        'type' => 'integer',
        'description' => 'page_size parameter.',
        'required' => false,
      ),
      'continuation_token' => array (
        'type' => 'string',
        'description' => 'continuation_token parameter.',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'The name parameter instructs the API to only include results that match that name.Multiple results may be returned. Only exact matches will be returned; substring matches and regexes will not be evaluated',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/stores';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'page_size' => 'page_size',
      'continuation_token' => 'continuation_token',
      'name' => 'name',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
