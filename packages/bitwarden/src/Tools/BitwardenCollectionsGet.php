<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Retrieve a collection.
 *
 * Maps to the official Bitwarden Public API endpoint get /public/collections/{id}.
 */
class BitwardenCollectionsGet extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_collections_get';
    protected const DESCRIPTION = 'Retrieve a collection.

Official Bitwarden Public API endpoint: GET /public/collections/{id}

Retrieves the details of an existing collection. You need only supply the unique collection identifier that was returned upon collection creation.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the collection to be retrieved.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/public/collections/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
