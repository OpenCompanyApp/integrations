<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a catalog_property.
 *
 * Maps to the official Rootly endpoint delete /v1/catalog_properties/{id}.
 */
class RootlyDeleteCatalogProperty extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_catalog_property';
    protected const DESCRIPTION = 'Delete a catalog_property

Official Rootly endpoint: DELETE /v1/catalog_properties/{id}

Delete a specific catalog_property by id - returns catalog_properties type';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/catalog_properties/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
