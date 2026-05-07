<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * Returns an OpenFGA store by its identifier.
 *
 * Maps to the official OpenFGA endpoint GET /stores/{store_id}.
 */
class OpenFGAGetStore extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_get_store';
    protected const DESCRIPTION = 'Returns an OpenFGA store by its identifier

Official OpenFGA endpoint: GET /stores/{store_id}.';
    protected const PARAMETERS = array (
      'store_id' => array (
        'type' => 'string',
        'description' => 'store_id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/stores/{store_id}';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
