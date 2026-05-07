<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a catalog.
 *
 * Maps to the official Rootly endpoint delete /v1/catalogs/{id}.
 */
class RootlyDeleteCatalog extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_catalog';
    protected const DESCRIPTION = 'Delete a catalog

Official Rootly endpoint: DELETE /v1/catalogs/{id}

Delete a specific catalog by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/catalogs/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
