<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List Catalog Properties (alias for fields).
 *
 * Maps to the official Rootly endpoint get /v1/catalogs/{catalog_id}/properties.
 */
class RootlyListCatalogProperties extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_catalog_properties';
    protected const DESCRIPTION = 'List Catalog Properties (alias for fields)

Official Rootly endpoint: GET /v1/catalogs/{catalog_id}/properties

List Catalog Properties - returns catalog_properties type';
    protected const PARAMETERS = array (
  'catalog_id' =>
  array (
    'type' => 'string',
    'description' => 'catalog_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/catalogs/{catalog_id}/properties';
    protected const PATH_PARAMS = array (
  'catalog_id' => 'catalog_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
