<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a playbook task.
 *
 * Maps to the official Rootly endpoint post /v1/playbooks/{playbook_id}/playbook_tasks.
 */
class RootlyCreatePlaybookTask extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_playbook_task';
    protected const DESCRIPTION = 'Creates a playbook task

Official Rootly endpoint: POST /v1/playbooks/{playbook_id}/playbook_tasks

Creates a new task from provided data';
    protected const PARAMETERS = array (
  'playbook_id' =>
  array (
    'type' => 'string',
    'description' => 'playbook_id parameter.',
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
    protected const PATH = '/v1/playbooks/{playbook_id}/playbook_tasks';
    protected const PATH_PARAMS = array (
  'playbook_id' => 'playbook_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
