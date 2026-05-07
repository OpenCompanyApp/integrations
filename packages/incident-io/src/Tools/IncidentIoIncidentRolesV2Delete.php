<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Delete Incident Roles V2.
 *
 * Maps to the official incident.io endpoint delete /v2/incident_roles/{id}.
 */
class IncidentIoIncidentRolesV2Delete extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_roles_v2_delete';
    protected const DESCRIPTION = 'Delete Incident Roles V2

Official incident.io endpoint: DELETE /v2/incident_roles/{id}

Removes an existing role';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the role',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v2/incident_roles/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
