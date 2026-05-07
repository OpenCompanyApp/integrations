<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Incident Statuses V1.
 *
 * Maps to the official incident.io endpoint get /v1/incident_statuses.
 */
class IncidentIoIncidentStatusesV1List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_statuses_v1_list';
    protected const DESCRIPTION = 'List Incident Statuses V1

Official incident.io endpoint: GET /v1/incident_statuses

List all incident statuses for an organisation.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_statuses';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
