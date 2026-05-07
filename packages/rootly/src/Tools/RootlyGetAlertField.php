<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an alert field.
 *
 * Maps to the official Rootly endpoint get /v1/alert_fields/{id}.
 */
class RootlyGetAlertField extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_alert_field';
    protected const DESCRIPTION = 'Retrieves an alert field

Official Rootly endpoint: GET /v1/alert_fields/{id}

Retrieves a specific alert field by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alert_fields/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
