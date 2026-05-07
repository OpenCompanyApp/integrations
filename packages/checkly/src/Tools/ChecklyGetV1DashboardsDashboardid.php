<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Show details of a specific dashboard. Rate-limiting is applied to this endpoint, you can send 10 requests / 20 seconds at most..
 *
 * Maps to the official Checkly endpoint GET /v1/dashboards/{dashboardId}.
 */
class ChecklyGetV1DashboardsDashboardid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_dashboards_dashboardid';
    protected const DESCRIPTION = 'Show details of a specific dashboard. Rate-limiting is applied to this endpoint, you can send 10 requests / 20 seconds at most.

Official Checkly endpoint: GET /v1/dashboards/{dashboardId}.';
    protected const PARAMETERS = array (
      'dashboard_id' => array (
        'type' => 'string',
        'description' => 'dashboardId parameter.',
        'required' => true,
      ),
      'type' => array (
        'type' => 'string',
        'description' => 'type parameter.',
        'required' => false,
        'enum' => array (
          'customUrl',
          'customDomain',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/dashboards/{dashboardId}';
    protected const PATH_PARAMS = array (
      'dashboardId' => 'dashboard_id',
    );
    protected const QUERY_PARAMS = array (
      'type' => 'type',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
