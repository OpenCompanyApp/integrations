<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ShowEntry Catalog V2.
 *
 * Maps to the official incident.io endpoint get /v2/catalog_entries/{id}.
 */
class IncidentIoCatalogV2ShowEntry extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v2_show_entry';
    protected const DESCRIPTION = 'ShowEntry Catalog V2

Official incident.io endpoint: GET /v2/catalog_entries/{id}

Show a single catalog entry.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'ID of this catalog entry',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
