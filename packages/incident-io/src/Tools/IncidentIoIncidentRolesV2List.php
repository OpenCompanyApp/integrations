<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Incident Roles V2.
 *
 * Maps to the official incident.io endpoint get /v2/incident_roles.
 */
class IncidentIoIncidentRolesV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_roles_v2_list';
    protected const DESCRIPTION = 'List Incident Roles V2

Official incident.io endpoint: GET /v2/incident_roles

List all incident roles for an organisation.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/incident_roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
