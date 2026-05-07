<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List playbooks.
 *
 * Maps to the official Rootly endpoint get /v1/playbooks.
 */
class RootlyListPlaybooks extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_playbooks';
    protected const DESCRIPTION = 'List playbooks

Official Rootly endpoint: GET /v1/playbooks

List playbooks';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: severities,environments,services',
    'enum' =>
    array (
      0 => 'severities',
      1 => 'environments',
      2 => 'services',
      3 => 'functionalities',
      4 => 'groups',
      5 => 'causes',
      6 => 'incident_types',
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
    protected const PATH = '/v1/playbooks';
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
