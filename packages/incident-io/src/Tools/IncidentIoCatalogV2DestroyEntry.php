<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * DestroyEntry Catalog V2.
 *
 * Maps to the official incident.io endpoint delete /v2/catalog_entries/{id}.
 */
class IncidentIoCatalogV2DestroyEntry extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v2_destroy_entry';
    protected const DESCRIPTION = 'DestroyEntry Catalog V2

Official incident.io endpoint: DELETE /v2/catalog_entries/{id}

Archives a catalog entry.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'ID of this catalog entry',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v2/catalog_entries/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
