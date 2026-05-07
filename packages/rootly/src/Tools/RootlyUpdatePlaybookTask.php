<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a playbook task.
 *
 * Maps to the official Rootly endpoint put /v1/playbook_tasks/{id}.
 */
class RootlyUpdatePlaybookTask extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_playbook_task';
    protected const DESCRIPTION = 'Update a playbook task

Official Rootly endpoint: PUT /v1/playbook_tasks/{id}

Update a specific playbook task by id';
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
    protected const PATH = '/v1/playbook_tasks/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
