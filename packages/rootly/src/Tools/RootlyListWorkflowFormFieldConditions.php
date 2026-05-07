<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List workflow form field conditions.
 *
 * Maps to the official Rootly endpoint get /v1/workflows/{workflow_id}/form_field_conditions.
 */
class RootlyListWorkflowFormFieldConditions extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_workflow_form_field_conditions';
    protected const DESCRIPTION = 'List workflow form field conditions

Official Rootly endpoint: GET /v1/workflows/{workflow_id}/form_field_conditions

List workflow form field conditions';
    protected const PARAMETERS = array (
  'workflow_id' =>
  array (
    'type' => 'string',
    'description' => 'workflow_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/workflows/{workflow_id}/form_field_conditions';
    protected const PATH_PARAMS = array (
  'workflow_id' => 'workflow_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
