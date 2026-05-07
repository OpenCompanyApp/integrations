<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a dashboard.
 *
 * Maps to the official Rootly endpoint delete /v1/dashboards/{id}.
 */
class RootlyDeleteDashboard extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_dashboard';
    protected const DESCRIPTION = 'Delete a dashboard

Official Rootly endpoint: DELETE /v1/dashboards/{id}

Delete a specific dashboard by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/dashboards/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
