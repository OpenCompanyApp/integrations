<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete an incident task.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incidents/{incident_id}/tasks/{task_id}.
 */
class FireHydrantDeleteIncidentTask extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident_task';
    protected const DESCRIPTION = 'Delete an incident task

Official FireHydrant endpoint: DELETE /v1/incidents/{incident_id}/tasks/{task_id}

Delete a task';
    protected const PARAMETERS = array (
  'task_id' =>
  array (
    'type' => 'string',
    'description' => 'task_id parameter.',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{incident_id}/tasks/{task_id}';
    protected const PATH_PARAMS = array (
  'task_id' => 'task_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
