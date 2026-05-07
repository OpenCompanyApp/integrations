<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * DestroyType Catalog V2.
 *
 * Maps to the official incident.io endpoint delete /v2/catalog_types/{id}.
 */
class IncidentIoCatalogV2DestroyType extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v2_destroy_type';
    protected const DESCRIPTION = 'DestroyType Catalog V2

Official incident.io endpoint: DELETE /v2/catalog_types/{id}

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
    protected const PATH = '/v2/catalog_types/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
