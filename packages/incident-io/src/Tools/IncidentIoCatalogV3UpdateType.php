<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * UpdateType Catalog V3.
 *
 * Maps to the official incident.io endpoint put /v3/catalog_types/{id}.
 */
class IncidentIoCatalogV3UpdateType extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v3_update_type';
    protected const DESCRIPTION = 'UpdateType Catalog V3

Official incident.io endpoint: PUT /v3/catalog_types/{id}

Updates an existing catalog type. The schema must be updated using the UpdateTypeSchema endpoint.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'ID of this catalog type',
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
    protected const PATH = '/v3/catalog_types/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
