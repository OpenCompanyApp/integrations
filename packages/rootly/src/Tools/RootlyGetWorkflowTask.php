<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a workflow task.
 *
 * Maps to the official Rootly endpoint get /v1/workflow_tasks/{id}.
 */
class RootlyGetWorkflowTask extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_workflow_task';
    protected const DESCRIPTION = 'Retrieves a workflow task

Official Rootly endpoint: GET /v1/workflow_tasks/{id}

Retrieves a specific workflow_task by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/workflow_tasks/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
