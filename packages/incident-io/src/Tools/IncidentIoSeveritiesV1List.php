<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Severities V1.
 *
 * Maps to the official incident.io endpoint get /v1/severities.
 */
class IncidentIoSeveritiesV1List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_severities_v1_list';
    protected const DESCRIPTION = 'List Severities V1

Official incident.io endpoint: GET /v1/severities

List all incident severities for an organisation.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/severities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
