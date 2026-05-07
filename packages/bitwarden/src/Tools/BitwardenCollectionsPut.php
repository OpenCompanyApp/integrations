<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Update a collection.
 *
 * Maps to the official Bitwarden Public API endpoint put /public/collections/{id}.
 */
class BitwardenCollectionsPut extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_collections_put';
    protected const DESCRIPTION = 'Update a collection.

Official Bitwarden Public API endpoint: PUT /public/collections/{id}

Updates the specified collection object. If a property is not provided, the value of the existing property will be reset.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the collection to be updated.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
  ),
);
    protected const METHOD = 'PUT';
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
