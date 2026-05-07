<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a workflow.
 *
 * Maps to the official Rootly endpoint get /v1/workflows/{id}.
 */
class RootlyGetWorkflow extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_workflow';
    protected const DESCRIPTION = 'Retrieves a workflow

Official Rootly endpoint: GET /v1/workflows/{id}

Retrieves a specific workflow by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: form_field_conditions,alert_field_conditions',
    'enum' =>
    array (
      0 => 'form_field_conditions',
      1 => 'alert_field_conditions',
      2 => 'genius_tasks',
      3 => 'genius_workflow_runs',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/workflows/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
