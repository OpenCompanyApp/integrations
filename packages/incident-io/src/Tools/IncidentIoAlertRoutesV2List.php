<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Alert Routes V2.
 *
 * Maps to the official incident.io endpoint get /v2/alert_routes.
 */
class IncidentIoAlertRoutesV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alert_routes_v2_list';
    protected const DESCRIPTION = 'List Alert Routes V2

Official incident.io endpoint: GET /v2/alert_routes

List all alert routes in your account.';
    protected const PARAMETERS = array (
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Number of alert routes to return per page',
    'required' => true,
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'The ID of the last alert route on the previous page',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/alert_routes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
