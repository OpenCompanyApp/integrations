<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ShowType Catalog V2.
 *
 * Maps to the official incident.io endpoint get /v2/catalog_types/{id}.
 */
class IncidentIoCatalogV2ShowType extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v2_show_type';
    protected const DESCRIPTION = 'ShowType Catalog V2

Official incident.io endpoint: GET /v2/catalog_types/{id}

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
    protected const PATH = '/v2/catalog_types/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
