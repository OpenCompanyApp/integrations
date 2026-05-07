<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a playbook task.
 *
 * Maps to the official Rootly endpoint delete /v1/playbook_tasks/{id}.
 */
class RootlyDeletePlaybookTask extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_playbook_task';
    protected const DESCRIPTION = 'Delete a playbook task

Official Rootly endpoint: DELETE /v1/playbook_tasks/{id}

Delete a specific playbook task by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/playbook_tasks/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
