<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a Catalog Entity Property.
 *
 * Maps to the official Rootly endpoint put /v1/catalog_entity_properties/{id}.
 */
class RootlyUpdateCatalogEntityProperty extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_catalog_entity_property';
    protected const DESCRIPTION = 'Update a Catalog Entity Property

Official Rootly endpoint: PUT /v1/catalog_entity_properties/{id}

**Deprecated:** This endpoint is deprecated, please use the `fields` attribute on catalog entities or native catalog endpoints (teams, services, functionalities, incident_types, causes, environments) to set field values instead.

Update a specific Catalog Entity Property by id.';
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
    protected const PATH = '/v1/catalog_entity_properties/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
