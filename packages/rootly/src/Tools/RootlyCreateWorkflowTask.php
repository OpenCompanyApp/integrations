<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a workflow task.
 *
 * Maps to the official Rootly endpoint post /v1/workflows/{workflow_id}/workflow_tasks.
 */
class RootlyCreateWorkflowTask extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_workflow_task';
    protected const DESCRIPTION = 'Creates a workflow task

Official Rootly endpoint: POST /v1/workflows/{workflow_id}/workflow_tasks

Creates a new workflow task from provided data';
    protected const PARAMETERS = array (
  'workflow_id' =>
  array (
    'type' => 'string',
    'description' => 'workflow_id parameter.',
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
    protected const PATH = '/v1/workflows/{workflow_id}/workflow_tasks';
    protected const PATH_PARAMS = array (
  'workflow_id' => 'workflow_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
