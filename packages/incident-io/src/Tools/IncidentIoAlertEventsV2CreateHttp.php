<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * CreateHTTP Alert Events V2.
 *
 * Maps to the official incident.io endpoint post /v2/alert_events/http/{alert_source_config_id}.
 */
class IncidentIoAlertEventsV2CreateHttp extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alert_events_v2_create_http';
    protected const DESCRIPTION = 'CreateHTTP Alert Events V2

Official incident.io endpoint: POST /v2/alert_events/http/{alert_source_config_id}

Create an alert event using an HTTP source.';
    protected const PARAMETERS = array (
  'token' =>
  array (
    'type' => 'string',
    'description' => 'Token used to authenticate the request, generated when configuring the alert source. Will be consumed via a URL query string parameter',
  ),
  'alert_source_config_id' =>
  array (
    'type' => 'string',
    'description' => 'Which alert source config produced this alert',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/alert_events/http/{alert_source_config_id}';
    protected const PATH_PARAMS = array (
  'alert_source_config_id' => 'alert_source_config_id',
);
    protected const QUERY_PARAMS = array (
  'token' => 'token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
