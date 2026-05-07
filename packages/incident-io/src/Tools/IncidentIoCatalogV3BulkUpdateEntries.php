<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * BulkUpdateEntries Catalog V3.
 *
 * Maps to the official incident.io endpoint post /v3/catalog_entries/actions/bulk_update.
 */
class IncidentIoCatalogV3BulkUpdateEntries extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v3_bulk_update_entries';
    protected const DESCRIPTION = 'BulkUpdateEntries Catalog V3

Official incident.io endpoint: POST /v3/catalog_entries/actions/bulk_update

Update multiple catalog entries in a single operation. You can update up to 250 entries at once. This operation is atomic - either all entries are updated successfully, or none are updated.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v3/catalog_entries/actions/bulk_update';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
