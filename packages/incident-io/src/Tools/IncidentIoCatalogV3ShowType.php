<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ShowType Catalog V3.
 *
 * Maps to the official incident.io endpoint get /v3/catalog_types/{id}.
 */
class IncidentIoCatalogV3ShowType extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v3_show_type';
    protected const DESCRIPTION = 'ShowType Catalog V3

Official incident.io endpoint: GET /v3/catalog_types/{id}

Show a single catalog type.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'ID of this catalog type',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v3/catalog_types/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
