<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a workflow.
 *
 * Maps to the official Rootly endpoint delete /v1/workflows/{id}.
 */
class RootlyDeleteWorkflow extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_workflow';
    protected const DESCRIPTION = 'Delete a workflow

Official Rootly endpoint: DELETE /v1/workflows/{id}

Delete a specific workflow by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/workflows/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
