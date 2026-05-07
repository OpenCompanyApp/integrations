<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a catalog_property (alias for field).
 *
 * Maps to the official Rootly endpoint put /v1/catalog_properties/{id}.
 */
class RootlyUpdateCatalogProperty extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_catalog_property';
    protected const DESCRIPTION = 'Update a catalog_property (alias for field)

Official Rootly endpoint: PUT /v1/catalog_properties/{id}

Update a specific catalog_property by id - returns catalog_properties type';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/catalog_properties/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
