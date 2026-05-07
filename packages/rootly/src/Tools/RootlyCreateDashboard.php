<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a dashboard.
 *
 * Maps to the official Rootly endpoint post /v1/dashboards.
 */
class RootlyCreateDashboard extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_dashboard';
    protected const DESCRIPTION = 'Creates a dashboard

Official Rootly endpoint: POST /v1/dashboards

Creates a new dashboard from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/dashboards';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
