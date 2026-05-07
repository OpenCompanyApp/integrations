<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Unassign a team from an incident.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incidents/{incident_id}/team_assignments/{team_assignment_id}.
 */
class FireHydrantDeleteIncidentTeamAssignment extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident_team_assignment';
    protected const DESCRIPTION = 'Unassign a team from an incident

Official FireHydrant endpoint: DELETE /v1/incidents/{incident_id}/team_assignments/{team_assignment_id}

Unassign a team from an incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'team_assignment_id' =>
  array (
    'type' => 'string',
    'description' => 'team_assignment_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{incident_id}/team_assignments/{team_assignment_id}';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
  'team_assignment_id' => 'team_assignment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
