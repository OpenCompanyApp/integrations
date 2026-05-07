<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes a dashboard..
 *
 * Maps to the official Checkly endpoint DELETE /v1/dashboards/{dashboardId}.
 */
class ChecklyDeleteV1DashboardsDashboardid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_dashboards_dashboardid';
    protected const DESCRIPTION = 'Permanently removes a dashboard.

Official Checkly endpoint: DELETE /v1/dashboards/{dashboardId}.';
    protected const PARAMETERS = array (
      'dashboard_id' => array (
        'type' => 'string',
        'description' => 'dashboardId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/dashboards/{dashboardId}';
    protected const PATH_PARAMS = array (
      'dashboardId' => 'dashboard_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
