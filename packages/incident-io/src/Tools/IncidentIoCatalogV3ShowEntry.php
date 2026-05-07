<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ShowEntry Catalog V3.
 *
 * Maps to the official incident.io endpoint get /v3/catalog_entries/{id}.
 */
class IncidentIoCatalogV3ShowEntry extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v3_show_entry';
    protected const DESCRIPTION = 'ShowEntry Catalog V3

Official incident.io endpoint: GET /v3/catalog_entries/{id}

Show a single catalog entry.';
    protected const PARAMETERS = array (
  'expand' =>
  array (
    'type' => 'boolean',
    'description' => 'Whether to include details of all attribute links (forwards and backwards) within the response. Default behaviour (no query param) is to include only forward links. When expand is false, we only show attributes of the catalog entry itself.When expand is true, we show forward and backward links',
  ),
  'id' =>
  array (
    'type' => 'string',
    'description' => 'ID of this catalog entry',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v3/catalog_entries/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'expand' => 'expand',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
