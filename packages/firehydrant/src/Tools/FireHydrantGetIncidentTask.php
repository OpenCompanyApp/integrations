<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an incident task.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/tasks/{task_id}.
 */
class FireHydrantGetIncidentTask extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_incident_task';
    protected const DESCRIPTION = 'Get an incident task

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/tasks/{task_id}

Retrieve a single task for an incident';
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
    protected const METHOD = 'get';
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
