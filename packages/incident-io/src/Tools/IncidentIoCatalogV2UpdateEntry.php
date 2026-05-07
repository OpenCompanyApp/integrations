<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * UpdateEntry Catalog V2.
 *
 * Maps to the official incident.io endpoint put /v2/catalog_entries/{id}.
 */
class IncidentIoCatalogV2UpdateEntry extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v2_update_entry';
    protected const DESCRIPTION = 'UpdateEntry Catalog V2

Official incident.io endpoint: PUT /v2/catalog_entries/{id}

Updates an existing catalog entry.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'ID of this catalog entry',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v2/catalog_entries/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
