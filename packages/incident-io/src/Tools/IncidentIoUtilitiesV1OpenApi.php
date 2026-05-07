<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * OpenAPI Utilities V1.
 *
 * Maps to the official incident.io endpoint get /v1/openapi.json.
 */
class IncidentIoUtilitiesV1OpenApi extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_utilities_v1_open_api';
    protected const DESCRIPTION = 'OpenAPI Utilities V1

Official incident.io endpoint: GET /v1/openapi.json

Get the OpenAPI (v2) definition.

**DEPRECATED**: Please use the OpenAPIV3 endpoint instead. The schema returned from this endpoint does not contain new options and endpoints added in 2025 and later.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/openapi.json';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
