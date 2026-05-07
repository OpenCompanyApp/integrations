<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Updates a dashboard. Will return a 409 when attempting to create a dashboard with a custom URL or custom domain that is already taken..
 *
 * Maps to the official Checkly endpoint PUT /v1/dashboards/{dashboardId}.
 */
class ChecklyPutV1DashboardsDashboardid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_dashboards_dashboardid';
    protected const DESCRIPTION = 'Updates a dashboard. Will return a 409 when attempting to create a dashboard with a custom URL or custom domain that is already taken.

Official Checkly endpoint: PUT /v1/dashboards/{dashboardId}.';
    protected const PARAMETERS = array (
      'dashboard_id' => array (
        'type' => 'string',
        'description' => 'dashboardId parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
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
