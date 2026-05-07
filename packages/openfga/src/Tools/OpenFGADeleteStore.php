<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * Delete an OpenFGA store. This does not delete the data associated with the store, like tuples or authorization models..
 *
 * Maps to the official OpenFGA endpoint DELETE /stores/{store_id}.
 */
class OpenFGADeleteStore extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_delete_store';
    protected const DESCRIPTION = 'Delete an OpenFGA store. This does not delete the data associated with the store, like tuples or authorization models.

Official OpenFGA endpoint: DELETE /stores/{store_id}.';
    protected const PARAMETERS = array (
      'store_id' => array (
        'type' => 'string',
        'description' => 'store_id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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
