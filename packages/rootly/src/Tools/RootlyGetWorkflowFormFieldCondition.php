<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a workflow form field condition.
 *
 * Maps to the official Rootly endpoint get /v1/workflow_form_field_conditions/{id}.
 */
class RootlyGetWorkflowFormFieldCondition extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_workflow_form_field_condition';
    protected const DESCRIPTION = 'Retrieves a workflow form field condition

Official Rootly endpoint: GET /v1/workflow_form_field_conditions/{id}

Retrieves a specific workflow form field condition by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
