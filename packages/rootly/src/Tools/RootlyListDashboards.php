<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List dashboards.
 *
 * Maps to the official Rootly endpoint get /v1/dashboards.
 */
class RootlyListDashboards extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_dashboards';
    protected const DESCRIPTION = 'List dashboards

Official Rootly endpoint: GET /v1/dashboards

List dashboards';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: panels',
    'enum' =>
    array (
      0 => 'panels',
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
    protected const PATH = '/v1/dashboards';
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
