<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Unassign a user from an incident.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incidents/{incident_id}/role_assignments/{role_assignment_id}.
 */
class FireHydrantDeleteIncidentRoleAssignment extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident_role_assignment';
    protected const DESCRIPTION = 'Unassign a user from an incident

Official FireHydrant endpoint: DELETE /v1/incidents/{incident_id}/role_assignments/{role_assignment_id}

Unassign a role from a user';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'role_assignment_id' =>
  array (
    'type' => 'string',
    'description' => 'role_assignment_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{incident_id}/role_assignments/{role_assignment_id}';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
  'role_assignment_id' => 'role_assignment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
