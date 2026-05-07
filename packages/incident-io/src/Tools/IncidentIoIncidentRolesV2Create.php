<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create Incident Roles V2.
 *
 * Maps to the official incident.io endpoint post /v2/incident_roles.
 */
class IncidentIoIncidentRolesV2Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_roles_v2_create';
    protected const DESCRIPTION = 'Create Incident Roles V2

Official incident.io endpoint: POST /v2/incident_roles

Create a new incident role';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/incident_roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
