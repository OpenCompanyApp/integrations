<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * UpdateEntry Catalog V3.
 *
 * Maps to the official incident.io endpoint put /v3/catalog_entries/{id}.
 */
class IncidentIoCatalogV3UpdateEntry extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v3_update_entry';
    protected const DESCRIPTION = 'UpdateEntry Catalog V3

Official incident.io endpoint: PUT /v3/catalog_entries/{id}

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
    protected const PATH = '/v3/catalog_entries/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
