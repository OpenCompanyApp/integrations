<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List retrospective steps.
 *
 * Maps to the official Rootly endpoint get /v1/retrospective_processes/{retrospective_process_id}/retrospective_steps.
 */
class RootlyListRetrospectiveSteps extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_retrospective_steps';
    protected const DESCRIPTION = 'List retrospective steps

Official Rootly endpoint: GET /v1/retrospective_processes/{retrospective_process_id}/retrospective_steps

List retrospective steps';
    protected const PARAMETERS = array (
  'retrospective_process_id' =>
  array (
    'type' => 'string',
    'description' => 'retrospective_process_id parameter.',
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
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'sort parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/retrospective_processes/{retrospective_process_id}/retrospective_steps';
    protected const PATH_PARAMS = array (
  'retrospective_process_id' => 'retrospective_process_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
