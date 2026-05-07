<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an incident role task.
 *
 * Maps to the official Rootly endpoint delete /v1/incident_role_tasks/{id}.
 */
class RootlyDeleteIncidentRoleTask extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_incident_role_task';
    protected const DESCRIPTION = 'Delete an incident role task

Official Rootly endpoint: DELETE /v1/incident_role_tasks/{id}

Delete a specific incident_role task by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incident_role_tasks/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
