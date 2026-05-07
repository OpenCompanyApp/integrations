<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Incident Timestamps V2.
 *
 * Maps to the official incident.io endpoint get /v2/incident_timestamps.
 */
class IncidentIoIncidentTimestampsV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_timestamps_v2_list';
    protected const DESCRIPTION = 'List Incident Timestamps V2

Official incident.io endpoint: GET /v2/incident_timestamps

List all incident timestamps for an organisation.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/incident_timestamps';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
