<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a Catalog Property (alias for field).
 *
 * Maps to the official Rootly endpoint post /v1/catalogs/{catalog_id}/properties.
 */
class RootlyCreateCatalogProperty extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_catalog_property';
    protected const DESCRIPTION = 'Creates a Catalog Property (alias for field)

Official Rootly endpoint: POST /v1/catalogs/{catalog_id}/properties

Creates a new Catalog Property - returns catalog_properties type';
    protected const PARAMETERS = array (
  'catalog_id' =>
  array (
    'type' => 'string',
    'description' => 'catalog_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/catalogs/{catalog_id}/properties';
    protected const PATH_PARAMS = array (
  'catalog_id' => 'catalog_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
