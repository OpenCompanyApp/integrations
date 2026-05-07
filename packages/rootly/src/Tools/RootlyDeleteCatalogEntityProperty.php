<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a Catalog Entity Property.
 *
 * Maps to the official Rootly endpoint delete /v1/catalog_entity_properties/{id}.
 */
class RootlyDeleteCatalogEntityProperty extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_catalog_entity_property';
    protected const DESCRIPTION = 'Delete a Catalog Entity Property

Official Rootly endpoint: DELETE /v1/catalog_entity_properties/{id}

**Deprecated:** This endpoint is deprecated, please use the `fields` attribute on catalog entities or native catalog endpoints (teams, services, functionalities, incident_types, causes, environments) to set field values instead.

Delete a specific Catalog Entity Property by id.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/catalog_entity_properties/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
