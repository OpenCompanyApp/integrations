<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a Catalog Entity.
 *
 * Maps to the official Rootly endpoint get /v1/catalog_entities/{id}.
 */
class RootlyGetCatalogEntity extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_catalog_entity';
    protected const DESCRIPTION = 'Retrieves a Catalog Entity

Official Rootly endpoint: GET /v1/catalog_entities/{id}

Retrieves a specific Catalog Entity by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: catalog,properties',
    'enum' =>
    array (
      0 => 'catalog',
      1 => 'properties',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/catalog_entities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
