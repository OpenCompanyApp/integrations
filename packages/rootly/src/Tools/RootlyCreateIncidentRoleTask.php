<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an incident role task.
 *
 * Maps to the official Rootly endpoint post /v1/incident_roles/{incident_role_id}/incident_role_tasks.
 */
class RootlyCreateIncidentRoleTask extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_incident_role_task';
    protected const DESCRIPTION = 'Creates an incident role task

Official Rootly endpoint: POST /v1/incident_roles/{incident_role_id}/incident_role_tasks

Creates a new task from provided data';
    protected const PARAMETERS = array (
  'incident_role_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_role_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incident_roles/{incident_role_id}/incident_role_tasks';
    protected const PATH_PARAMS = array (
  'incident_role_id' => 'incident_role_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
