<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Create alert event.
 *
 * Maps to the official Rootly endpoint post /v1/alerts/{alert_id}/events.
 */
class RootlyCreateAlertEvent extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_alert_event';
    protected const DESCRIPTION = 'Create alert event

Official Rootly endpoint: POST /v1/alerts/{alert_id}/events

Creates a new alert event';
    protected const PARAMETERS = array (
  'alert_id' =>
  array (
    'type' => 'string',
    'description' => 'alert_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/alerts/{alert_id}/events';
    protected const PATH_PARAMS = array (
  'alert_id' => 'alert_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
