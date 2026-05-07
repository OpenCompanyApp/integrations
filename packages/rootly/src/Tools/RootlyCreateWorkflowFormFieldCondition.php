<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a workflow form field condition.
 *
 * Maps to the official Rootly endpoint post /v1/workflows/{workflow_id}/form_field_conditions.
 */
class RootlyCreateWorkflowFormFieldCondition extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_workflow_form_field_condition';
    protected const DESCRIPTION = 'Creates a workflow form field condition

Official Rootly endpoint: POST /v1/workflows/{workflow_id}/form_field_conditions

Creates a new workflow form field condition from provided data';
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
    protected const PATH = '/v1/workflows/{workflow_id}/form_field_conditions';
    protected const PATH_PARAMS = array (
  'workflow_id' => 'workflow_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
