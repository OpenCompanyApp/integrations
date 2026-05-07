<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List retrospective processes.
 *
 * Maps to the official Rootly endpoint get /v1/retrospective_processes.
 */
class RootlyListRetrospectiveProcesses extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_retrospective_processes';
    protected const DESCRIPTION = 'List retrospective processes

Official Rootly endpoint: GET /v1/retrospective_processes

List retrospective processes';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: retrospective_steps,severities',
    'enum' =>
    array (
      0 => 'retrospective_steps',
      1 => 'severities',
      2 => 'incident_types',
      3 => 'groups',
    ),
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
    protected const PATH = '/v1/retrospective_processes';
    protected const PATH_PARAMS = array (
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
