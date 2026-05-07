<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieve alert event.
 *
 * Maps to the official Rootly endpoint get /v1/alert_events/{id}.
 */
class RootlyGetAlertEvent extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_alert_event';
    protected const DESCRIPTION = 'Retrieve alert event

Official Rootly endpoint: GET /v1/alert_events/{id}

Retrieves a specific alert_event by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alert_events/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
