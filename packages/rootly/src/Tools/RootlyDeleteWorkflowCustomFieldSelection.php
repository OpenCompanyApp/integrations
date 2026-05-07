<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] Delete a workflow custom field selection.
 *
 * Maps to the official Rootly endpoint delete /v1/workflow_custom_field_selections/{id}.
 */
class RootlyDeleteWorkflowCustomFieldSelection extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_workflow_custom_field_selection';
    protected const DESCRIPTION = '[DEPRECATED] Delete a workflow custom field selection

Official Rootly endpoint: DELETE /v1/workflow_custom_field_selections/{id}

[DEPRECATED] Use form field endpoints instead. Delete a specific workflow custom field selection by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/workflow_custom_field_selections/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
