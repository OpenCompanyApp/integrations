<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a dashboard panel.
 *
 * Maps to the official Rootly endpoint delete /v1/dashboard_panels/{id}.
 */
class RootlyDeleteDashboardPanel extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_dashboard_panel';
    protected const DESCRIPTION = 'Delete a dashboard panel

Official Rootly endpoint: DELETE /v1/dashboard_panels/{id}

Delete a specific dashboard panel by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/dashboard_panels/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
