<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete alert event.
 *
 * Maps to the official Rootly endpoint delete /v1/alert_events/{id}.
 */
class RootlyDeleteAlertEvent extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_alert_event';
    protected const DESCRIPTION = 'Delete alert event

Official Rootly endpoint: DELETE /v1/alert_events/{id}

Deletes a specific alert event. Only alert events with kind \'note\' (user-created notes) can be deleted. System-generated events are immutable to maintain audit trail integrity.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
