<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Delete a collection.
 *
 * Maps to the official Bitwarden Public API endpoint delete /public/collections/{id}.
 */
class BitwardenCollectionsDelete extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_collections_delete';
    protected const DESCRIPTION = 'Delete a collection.

Official Bitwarden Public API endpoint: DELETE /public/collections/{id}

Permanently deletes a collection. This cannot be undone.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the collection to be deleted.',
  ),
);
    protected const METHOD = 'DELETE';
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
