<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Sets dashboard to user default.
 *
 * Maps to the official Rootly endpoint post /v1/dashboards/{id}/set_default.
 */
class RootlySetDefaultDashboard extends AbstractRootlyTool
{
    protected const NAME = 'rootly_set_default_dashboard';
    protected const DESCRIPTION = 'Sets dashboard to user default

Official Rootly endpoint: POST /v1/dashboards/{id}/set_default

Sets dashboard to user default';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/dashboards/{id}/set_default';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
