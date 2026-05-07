<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a dashboard panel.
 *
 * Maps to the official Rootly endpoint put /v1/dashboard_panels/{id}.
 */
class RootlyUpdateDashboardPanel extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_dashboard_panel';
    protected const DESCRIPTION = 'Update a dashboard panel

Official Rootly endpoint: PUT /v1/dashboard_panels/{id}

Update a specific dashboard panel by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/dashboard_panels/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
