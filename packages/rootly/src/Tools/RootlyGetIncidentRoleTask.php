<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident role task.
 *
 * Maps to the official Rootly endpoint get /v1/incident_role_tasks/{id}.
 */
class RootlyGetIncidentRoleTask extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_role_task';
    protected const DESCRIPTION = 'Retrieves an incident role task

Official Rootly endpoint: GET /v1/incident_role_tasks/{id}

Retrieves a specific incident_role_task by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
