<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListEntries Catalog V2.
 *
 * Maps to the official incident.io endpoint get /v2/catalog_entries.
 */
class IncidentIoCatalogV2ListEntries extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v2_list_entries';
    protected const DESCRIPTION = 'ListEntries Catalog V2

Official incident.io endpoint: GET /v2/catalog_entries

List entries for a catalog type.';
    protected const PARAMETERS = array (
  'catalog_type_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of this catalog type',
    'required' => true,
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Integer number of records to return',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'An record\'s ID. This endpoint will return a list of records after this ID in relation to the API response order.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/catalog_entries';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'catalog_type_id' => 'catalog_type_id',
  'page_size' => 'page_size',
  'after' => 'after',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
