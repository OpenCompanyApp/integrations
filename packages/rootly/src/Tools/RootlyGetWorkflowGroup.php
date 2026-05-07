<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a workflow group.
 *
 * Maps to the official Rootly endpoint get /v1/workflow_groups/{id}.
 */
class RootlyGetWorkflowGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_workflow_group';
    protected const DESCRIPTION = 'Retrieves a workflow group

Official Rootly endpoint: GET /v1/workflow_groups/{id}

Retrieves a specific workflow group by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/workflow_groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
