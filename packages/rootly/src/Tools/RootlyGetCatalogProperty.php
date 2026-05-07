<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a Catalog Property (alias for field).
 *
 * Maps to the official Rootly endpoint get /v1/catalog_properties/{id}.
 */
class RootlyGetCatalogProperty extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_catalog_property';
    protected const DESCRIPTION = 'Retrieves a Catalog Property (alias for field)

Official Rootly endpoint: GET /v1/catalog_properties/{id}

Retrieves a specific Catalog Property by id - returns catalog_properties type';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
