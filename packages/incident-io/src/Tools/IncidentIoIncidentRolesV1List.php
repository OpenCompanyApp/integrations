<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Incident Roles V1.
 *
 * Maps to the official incident.io endpoint get /v1/incident_roles.
 */
class IncidentIoIncidentRolesV1List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_roles_v1_list';
    protected const DESCRIPTION = 'List Incident Roles V1

Official incident.io endpoint: GET /v1/incident_roles

List all incident roles for an organisation.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
