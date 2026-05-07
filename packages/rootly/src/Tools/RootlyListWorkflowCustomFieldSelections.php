<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] List workflow custom field selections.
 *
 * Maps to the official Rootly endpoint get /v1/workflows/{workflow_id}/custom_field_selections.
 */
class RootlyListWorkflowCustomFieldSelections extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_workflow_custom_field_selections';
    protected const DESCRIPTION = '[DEPRECATED] List workflow custom field selections

Official Rootly endpoint: GET /v1/workflows/{workflow_id}/custom_field_selections

[DEPRECATED] Use form field endpoints instead. List workflow custom field selections';
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
    protected const PATH = '/v1/workflows/{workflow_id}/custom_field_selections';
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
