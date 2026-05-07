<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List dashboard panels.
 *
 * Maps to the official Rootly endpoint get /v1/dashboards/{dashboard_id}/panels.
 */
class RootlyListDashboardPanels extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_dashboard_panels';
    protected const DESCRIPTION = 'List dashboard panels

Official Rootly endpoint: GET /v1/dashboards/{dashboard_id}/panels

List dashboard panels';
    protected const PARAMETERS = array (
  'dashboard_id' =>
  array (
    'type' => 'string',
    'description' => 'dashboard_id parameter.',
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
    protected const PATH = '/v1/dashboards/{dashboard_id}/panels';
    protected const PATH_PARAMS = array (
  'dashboard_id' => 'dashboard_id',
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
