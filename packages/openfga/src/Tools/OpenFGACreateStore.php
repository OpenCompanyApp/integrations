<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * Create a unique OpenFGA store which will be used to store authorization models and relationship tuples..
 *
 * Maps to the official OpenFGA endpoint POST /stores.
 */
class OpenFGACreateStore extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_create_store';
    protected const DESCRIPTION = 'Create a unique OpenFGA store which will be used to store authorization models and relationship tuples.

Official OpenFGA endpoint: POST /stores.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the OpenFGA API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/stores';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
