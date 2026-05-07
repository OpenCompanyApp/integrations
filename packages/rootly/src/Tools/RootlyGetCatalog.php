<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a catalog.
 *
 * Maps to the official Rootly endpoint get /v1/catalogs/{id}.
 */
class RootlyGetCatalog extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_catalog';
    protected const DESCRIPTION = 'Retrieves a catalog

Official Rootly endpoint: GET /v1/catalogs/{id}

Retrieves a specific catalog by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
