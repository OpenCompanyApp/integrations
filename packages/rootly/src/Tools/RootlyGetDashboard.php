<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a dashboard.
 *
 * Maps to the official Rootly endpoint get /v1/dashboards/{id}.
 */
class RootlyGetDashboard extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_dashboard';
    protected const DESCRIPTION = 'Retrieves a dashboard

Official Rootly endpoint: GET /v1/dashboards/{id}

Retrieves a specific dashboard by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: panels',
    'enum' =>
    array (
      0 => 'panels',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/dashboards/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
