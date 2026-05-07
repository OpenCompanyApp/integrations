<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] Creates a workflow custom field selection.
 *
 * Maps to the official Rootly endpoint post /v1/workflows/{workflow_id}/custom_field_selections.
 */
class RootlyCreateWorkflowCustomFieldSelection extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_workflow_custom_field_selection';
    protected const DESCRIPTION = '[DEPRECATED] Creates a workflow custom field selection

Official Rootly endpoint: POST /v1/workflows/{workflow_id}/custom_field_selections

[DEPRECATED] Use form field endpoints instead. Creates a new workflow custom field selection from provided data';
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
    protected const PATH = '/v1/workflows/{workflow_id}/custom_field_selections';
    protected const PATH_PARAMS = array (
  'workflow_id' => 'workflow_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
