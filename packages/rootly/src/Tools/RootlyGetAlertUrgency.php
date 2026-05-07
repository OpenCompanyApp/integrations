<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an alert urgency.
 *
 * Maps to the official Rootly endpoint get /v1/alert_urgencies/{id}.
 */
class RootlyGetAlertUrgency extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_alert_urgency';
    protected const DESCRIPTION = 'Retrieves an alert urgency

Official Rootly endpoint: GET /v1/alert_urgencies/{id}

Retrieves a specific alert urgency by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alert_urgencies/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
