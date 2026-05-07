<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a workflow_form field condition.
 *
 * Maps to the official Rootly endpoint delete /v1/workflow_form_field_conditions/{id}.
 */
class RootlyDeleteWorkflowFormFieldCondition extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_workflow_form_field_condition';
    protected const DESCRIPTION = 'Delete a workflow_form field condition

Official Rootly endpoint: DELETE /v1/workflow_form_field_conditions/{id}

Delete a specific workflow form field condition by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/workflow_form_field_conditions/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
