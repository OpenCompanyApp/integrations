<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a dashboard panel.
 *
 * Maps to the official Rootly endpoint post /v1/dashboards/{dashboard_id}/panels.
 */
class RootlyCreateDashboardPanel extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_dashboard_panel';
    protected const DESCRIPTION = 'Creates a dashboard panel

Official Rootly endpoint: POST /v1/dashboards/{dashboard_id}/panels

Creates a new dashboard panel from provided data';
    protected const PARAMETERS = array (
  'dashboard_id' =>
  array (
    'type' => 'string',
    'description' => 'dashboard_id parameter.',
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
    protected const PATH = '/v1/dashboards/{dashboard_id}/panels';
    protected const PATH_PARAMS = array (
  'dashboard_id' => 'dashboard_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
