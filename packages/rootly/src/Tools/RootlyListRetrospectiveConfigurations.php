<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List retrospective configurations.
 *
 * Maps to the official Rootly endpoint get /v1/retrospective_configurations.
 */
class RootlyListRetrospectiveConfigurations extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_retrospective_configurations';
    protected const DESCRIPTION = 'List retrospective configurations

Official Rootly endpoint: GET /v1/retrospective_configurations

List retrospective configurations';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: severities,groups',
    'enum' =>
    array (
      0 => 'severities',
      1 => 'groups',
      2 => 'incident_types',
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
  'filter_kind' =>
  array (
    'type' => 'string',
    'description' => 'filter[kind] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/retrospective_configurations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[kind]' => 'filter_kind',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
