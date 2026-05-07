<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a workflow task.
 *
 * Maps to the official Rootly endpoint delete /v1/workflow_tasks/{id}.
 */
class RootlyDeleteWorkflowTask extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_workflow_task';
    protected const DESCRIPTION = 'Delete a workflow task

Official Rootly endpoint: DELETE /v1/workflow_tasks/{id}

Delete a specific workflow task by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
