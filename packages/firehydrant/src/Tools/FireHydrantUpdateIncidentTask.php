<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an incident task.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incidents/{incident_id}/tasks/{task_id}.
 */
class FireHydrantUpdateIncidentTask extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_incident_task';
    protected const DESCRIPTION = 'Update an incident task

Official FireHydrant endpoint: PATCH /v1/incidents/{incident_id}/tasks/{task_id}

Update a task\'s attributes';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/incidents/{incident_id}/tasks/{task_id}';
    protected const PATH_PARAMS = array (
  'task_id' => 'task_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
