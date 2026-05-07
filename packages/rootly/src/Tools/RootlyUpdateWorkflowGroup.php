<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a workflow group.
 *
 * Maps to the official Rootly endpoint put /v1/workflow_groups/{id}.
 */
class RootlyUpdateWorkflowGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_workflow_group';
    protected const DESCRIPTION = 'Update a workflow group

Official Rootly endpoint: PUT /v1/workflow_groups/{id}

Update a specific workflow group by id';
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
    protected const PATH = '/v1/workflow_groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
