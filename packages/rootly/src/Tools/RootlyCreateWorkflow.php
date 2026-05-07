<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a workflow.
 *
 * Maps to the official Rootly endpoint post /v1/workflows.
 */
class RootlyCreateWorkflow extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_workflow';
    protected const DESCRIPTION = 'Creates a workflow

Official Rootly endpoint: POST /v1/workflows

Creates a new workflow from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/workflows';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
