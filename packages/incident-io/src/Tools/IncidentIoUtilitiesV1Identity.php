<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Identity Utilities V1.
 *
 * Maps to the official incident.io endpoint get /v1/identity.
 */
class IncidentIoUtilitiesV1Identity extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_utilities_v1_identity';
    protected const DESCRIPTION = 'Identity Utilities V1

Official incident.io endpoint: GET /v1/identity

Test if your API key is valid, and which roles it has.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/identity';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
