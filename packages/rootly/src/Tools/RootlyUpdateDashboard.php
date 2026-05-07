<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a dashboard.
 *
 * Maps to the official Rootly endpoint put /v1/dashboards/{id}.
 */
class RootlyUpdateDashboard extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_dashboard';
    protected const DESCRIPTION = 'Update a dashboard

Official Rootly endpoint: PUT /v1/dashboards/{id}

Update a specific dashboard by id';
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
    protected const PATH = '/v1/dashboards/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
