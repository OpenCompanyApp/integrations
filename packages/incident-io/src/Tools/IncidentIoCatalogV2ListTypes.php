<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListTypes Catalog V2.
 *
 * Maps to the official incident.io endpoint get /v2/catalog_types.
 */
class IncidentIoCatalogV2ListTypes extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v2_list_types';
    protected const DESCRIPTION = 'ListTypes Catalog V2

Official incident.io endpoint: GET /v2/catalog_types

List all catalog types for an organisation, including those synced from external resources.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/catalog_types';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
