<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * The Streamed ListObjects API is very similar to the the ListObjects API, with two differences: 1. Instead of collecting all objects before returning a response, it streams them to the client as they are collected. 2. The number of results returned is only limited by the execution timeout specified in the flag OPENFGA_LIST_OBJECTS_DEADLINE..
 *
 * Maps to the official OpenFGA endpoint POST /stores/{store_id}/streamed-list-objects.
 */
class OpenFGAStreamedListObjects extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_streamed_list_objects';
    protected const DESCRIPTION = 'The Streamed ListObjects API is very similar to the the ListObjects API, with two differences: 1. Instead of collecting all objects before returning a response, it streams them to the client as they are collected. 2. The number of results returned is only limited by the execution timeout specified in the flag OPENFGA_LIST_OBJECTS_DEADLINE.

Official OpenFGA endpoint: POST /stores/{store_id}/streamed-list-objects.';
    protected const PARAMETERS = array (
      'store_id' => array (
        'type' => 'string',
        'description' => 'store_id parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the OpenFGA API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/stores/{store_id}/streamed-list-objects';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
