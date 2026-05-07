<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * CreateEntry Catalog V2.
 *
 * Maps to the official incident.io endpoint post /v2/catalog_entries.
 */
class IncidentIoCatalogV2CreateEntry extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v2_create_entry';
    protected const DESCRIPTION = 'CreateEntry Catalog V2

Official incident.io endpoint: POST /v2/catalog_entries

Create an entry within the catalog. We support a maximum of 50,000 entries per type.

If you call this API with a payload where the external_id and catalog_type_id match an existing entry, the existing entry will be updated.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/catalog_entries';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
