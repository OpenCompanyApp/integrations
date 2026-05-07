<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListResources Catalog V3.
 *
 * Maps to the official incident.io endpoint get /v3/catalog_resources.
 */
class IncidentIoCatalogV3ListResources extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_catalog_v3_list_resources';
    protected const DESCRIPTION = 'ListResources Catalog V3

Official incident.io endpoint: GET /v3/catalog_resources

List available engine resources for the catalog.

A resource represents a type of data that can be held within the catalog, so this
endpoint can be used to see what attribute types can be used when updating the
schema of a catalog type.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v3/catalog_resources';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
