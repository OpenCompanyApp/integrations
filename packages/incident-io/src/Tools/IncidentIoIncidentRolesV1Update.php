<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Update Incident Roles V1.
 *
 * Maps to the official incident.io endpoint put /v1/incident_roles/{id}.
 */
class IncidentIoIncidentRolesV1Update extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_roles_v1_update';
    protected const DESCRIPTION = 'Update Incident Roles V1

Official incident.io endpoint: PUT /v1/incident_roles/{id}

Update an existing incident role';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the role',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/incident_roles/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
