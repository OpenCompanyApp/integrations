<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListEntries Catalog V3.
 *
 * Maps to the official incident.io endpoint get /v3/catalog_entries.
 */
class IncidentIoCatalogV3ListEntries extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v3_list_entries';
    protected const DESCRIPTION = 'ListEntries Catalog V3

Official incident.io endpoint: GET /v3/catalog_entries

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
    'description' => 'The integer number of records to return',
    'required' => true,
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'An record\'s ID. This endpoint will return a list of records after this ID in relation to the API response order.',
  ),
  'identifier' =>
  array (
    'type' => 'string',
    'description' => 'If specified, only entries with this identifier will be returned. This will search by ID, external ID, and aliases.

If \'use name as identifier\' is enabled for the catalog type, this will also match on name.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v3/catalog_entries';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'catalog_type_id' => 'catalog_type_id',
  'page_size' => 'page_size',
  'after' => 'after',
  'identifier' => 'identifier',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
