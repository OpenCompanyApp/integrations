<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List playbook tasks.
 *
 * Maps to the official Rootly endpoint get /v1/playbooks/{playbook_id}/playbook_tasks.
 */
class RootlyListPlaybookTasks extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_playbook_tasks';
    protected const DESCRIPTION = 'List playbook tasks

Official Rootly endpoint: GET /v1/playbooks/{playbook_id}/playbook_tasks

List playbook tasks';
    protected const PARAMETERS = array (
  'playbook_id' =>
  array (
    'type' => 'string',
    'description' => 'playbook_id parameter.',
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
    protected const PATH = '/v1/playbooks/{playbook_id}/playbook_tasks';
    protected const PATH_PARAMS = array (
  'playbook_id' => 'playbook_id',
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
