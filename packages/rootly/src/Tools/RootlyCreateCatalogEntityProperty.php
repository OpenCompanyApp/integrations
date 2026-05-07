<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a Catalog Entity Property.
 *
 * Maps to the official Rootly endpoint post /v1/catalog_entities/{catalog_entity_id}/properties.
 */
class RootlyCreateCatalogEntityProperty extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_catalog_entity_property';
    protected const DESCRIPTION = 'Creates a Catalog Entity Property

Official Rootly endpoint: POST /v1/catalog_entities/{catalog_entity_id}/properties

**Deprecated:** This endpoint is deprecated, please use the `fields` attribute on catalog entities or native catalog endpoints (teams, services, functionalities, incident_types, causes, environments) to set field values instead.

Creates a new Catalog Entity Property from provided data.';
    protected const PARAMETERS = array (
  'catalog_entity_id' =>
  array (
    'type' => 'string',
    'description' => 'catalog_entity_id parameter.',
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
    protected const PATH = '/v1/catalog_entities/{catalog_entity_id}/properties';
    protected const PATH_PARAMS = array (
  'catalog_entity_id' => 'catalog_entity_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
