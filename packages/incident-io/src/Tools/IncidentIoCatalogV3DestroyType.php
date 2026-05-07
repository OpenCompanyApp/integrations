<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * DestroyType Catalog V3.
 *
 * Maps to the official incident.io endpoint delete /v3/catalog_types/{id}.
 */
class IncidentIoCatalogV3DestroyType extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v3_destroy_type';
    protected const DESCRIPTION = 'DestroyType Catalog V3

Official incident.io endpoint: DELETE /v3/catalog_types/{id}

Archives a catalog type and associated entries.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'ID of this catalog type',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v3/catalog_types/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
