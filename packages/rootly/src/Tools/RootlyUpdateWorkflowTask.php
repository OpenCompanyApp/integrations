<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a workflow task.
 *
 * Maps to the official Rootly endpoint put /v1/workflow_tasks/{id}.
 */
class RootlyUpdateWorkflowTask extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_workflow_task';
    protected const DESCRIPTION = 'Update a workflow task

Official Rootly endpoint: PUT /v1/workflow_tasks/{id}

Update a specific workflow task by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/workflow_tasks/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
