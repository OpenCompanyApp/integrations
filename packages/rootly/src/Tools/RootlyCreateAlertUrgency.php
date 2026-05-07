<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an alert urgency.
 *
 * Maps to the official Rootly endpoint post /v1/alert_urgencies.
 */
class RootlyCreateAlertUrgency extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_alert_urgency';
    protected const DESCRIPTION = 'Creates an alert urgency

Official Rootly endpoint: POST /v1/alert_urgencies

Creates a new alert urgency from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/alert_urgencies';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
