<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update alert event.
 *
 * Maps to the official Rootly endpoint patch /v1/alert_events/{id}.
 */
class RootlyUpdateAlertEvent extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_alert_event';
    protected const DESCRIPTION = 'Update alert event

Official Rootly endpoint: PATCH /v1/alert_events/{id}

Updates a specific alert event. Only alert events with kind \'note\' (user-created notes) can be updated. System-generated events are immutable to maintain audit trail integrity.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
  ),
);
    protected const METHOD = 'patch';
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
