<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a workflow.
 *
 * Maps to the official Rootly endpoint put /v1/workflows/{id}.
 */
class RootlyUpdateWorkflow extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_workflow';
    protected const DESCRIPTION = 'Update a workflow

Official Rootly endpoint: PUT /v1/workflows/{id}

Update a specific workflow by id';
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
    protected const PATH = '/v1/workflows/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
