<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * OpenAPIV3 Utilities V1.
 *
 * Maps to the official incident.io endpoint get /v1/openapiV3.json.
 */
class IncidentIoUtilitiesV1OpenApiv3 extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_utilities_v1_open_apiv3';
    protected const DESCRIPTION = 'OpenAPIV3 Utilities V1

Official incident.io endpoint: GET /v1/openapiV3.json

Get the OpenAPI (v3) definition.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/openapiV3.json';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
