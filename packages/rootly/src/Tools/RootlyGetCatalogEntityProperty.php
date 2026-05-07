<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a Catalog Entity Property.
 *
 * Maps to the official Rootly endpoint get /v1/catalog_entity_properties/{id}.
 */
class RootlyGetCatalogEntityProperty extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_catalog_entity_property';
    protected const DESCRIPTION = 'Retrieves a Catalog Entity Property

Official Rootly endpoint: GET /v1/catalog_entity_properties/{id}

**Deprecated:** This endpoint is deprecated, please use `include=fields` on catalog entities or native catalog endpoints (teams, services, functionalities, incident_types, causes, environments) to retrieve field values instead.

Retrieves a specific Catalog Entity Property by id.';
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
    'description' => 'comma separated if needed. eg: catalog_entity,catalog_field',
    'enum' =>
    array (
      0 => 'catalog_entity',
      1 => 'catalog_field',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/catalog_entity_properties/{id}';
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
