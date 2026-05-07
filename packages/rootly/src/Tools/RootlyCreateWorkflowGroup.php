<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a workflow group.
 *
 * Maps to the official Rootly endpoint post /v1/workflow_groups.
 */
class RootlyCreateWorkflowGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_workflow_group';
    protected const DESCRIPTION = 'Creates a workflow group

Official Rootly endpoint: POST /v1/workflow_groups

Creates a new workflow group from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/workflow_groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
