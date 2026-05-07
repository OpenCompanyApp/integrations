<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List incident assignees.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/role_assignments.
 */
class FireHydrantListIncidentRoleAssignments extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_role_assignments';
    protected const DESCRIPTION = 'List incident assignees

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/role_assignments

Retrieve a list of all of the current role assignments for the incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'status' =>
  array (
    'type' => 'string',
    'description' => 'Filter on status of the role assignment',
    'enum' =>
    array (
      0 => 'active',
      1 => 'inactive',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/role_assignments';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'status' => 'status',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
