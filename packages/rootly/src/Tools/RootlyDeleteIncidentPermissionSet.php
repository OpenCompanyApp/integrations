<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an incident_permission_set.
 *
 * Maps to the official Rootly endpoint delete /v1/incident_permission_sets/{id}.
 */
class RootlyDeleteIncidentPermissionSet extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_incident_permission_set';
    protected const DESCRIPTION = 'Delete an incident_permission_set

Official Rootly endpoint: DELETE /v1/incident_permission_sets/{id}

Delete a specific incident_permission_set by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incident_permission_sets/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
