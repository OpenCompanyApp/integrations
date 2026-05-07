<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * The ReadAssertions API will return, for a given authorization model id, all the assertions stored for it..
 *
 * Maps to the official OpenFGA endpoint GET /stores/{store_id}/assertions/{authorization_model_id}.
 */
class OpenFGAReadAssertions extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_read_assertions';
    protected const DESCRIPTION = 'The ReadAssertions API will return, for a given authorization model id, all the assertions stored for it.

Official OpenFGA endpoint: GET /stores/{store_id}/assertions/{authorization_model_id}.';
    protected const PARAMETERS = array (
      'store_id' => array (
        'type' => 'string',
        'description' => 'store_id parameter.',
        'required' => true,
      ),
      'authorization_model_id' => array (
        'type' => 'string',
        'description' => 'authorization_model_id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/stores/{store_id}/assertions/{authorization_model_id}';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
      'authorization_model_id' => 'authorization_model_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
